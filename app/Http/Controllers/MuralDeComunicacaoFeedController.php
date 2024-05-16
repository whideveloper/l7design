<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use App\Models\MuralDeApoio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MuralDeComunicacaoFeed;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\MuralDeComunicacaoCategory;
use App\Http\Controllers\Helpers\HelperArchive;

class MuralDeComunicacaoFeedController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/mural-de-comunicacao/';
    public function index()
    {
        $muralDeComunicacaoFeeds = MuralDeComunicacaoFeed::sorting()->get();
        return view('Admin.cruds.muralDeComunicacaoFeed.index',[
            'muralDeComunicacaoFeeds' => $muralDeComunicacaoFeeds
        ]);
    }

    public function create()
    {
        $categoryTitle = [];
        $muralDeComunicacaoCategory = MuralDeComunicacaoCategory::active()->get();
        foreach($muralDeComunicacaoCategory as $title){
            $categoryTitle[$title->id] = $title->title;
        }
        return view('Admin.cruds.muralDeComunicacaoFeed.create', [
            'muralDeComunicacaoCategory' => $categoryTitle
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $texto = $request->input('text');
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;

            $muralDeApoio = MuralDeApoio::first();

            if (!MuralDeComunicacaoFeed::create($data, $texto)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }

            Session::flash('success', 'Mural de comunicação cadastrado com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.muralDeApoio.edit', [
                'muralDeApoio' => $muralDeApoio
            ]);
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Mural de comunicação!');
            return redirect()->back();
        }
    }

    public function edit(Request $request,MuralDeComunicacaoFeed $muralDeComunicacaoFeed)
    {
        $categoryTitle = [];
        $muralDeComunicacaoCategory = MuralDeComunicacaoCategory::active()->get();
        foreach($muralDeComunicacaoCategory as $title){
            $categoryTitle[$title->id] = $title->title;
        }
        $muralDeApoio = MuralDeApoio::first();

        return view('Admin.cruds.muralDeComunicacaoFeed.edit', [
            'muralDeComunicacaoFeed' => $muralDeComunicacaoFeed,
            'muralDeComunicacaoCategory' => $categoryTitle,
            'title' => $request->title??null,
            'muralDeApoio' => $muralDeApoio
        ]);
    }

    public function update(Request $request, MuralDeComunicacaoFeed $muralDeComunicacaoFeed)
    {
        $data = $request->all();
        $texto = $request->input('text');
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                Storage::delete($muralDeComunicacaoFeed->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($muralDeComunicacaoFeed->$inputFile);
                $data['path_image'] = null;
            }
            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;


            $muralDeComunicacaoFeed->fill($data, $texto)->save();

            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            $muralDeApoio = MuralDeApoio::first();
            DB::commit();
            Session::flash('success', 'Mural de comunicação atualizada com sucesso!');
            return redirect()->route('admin.dashboard.muralDeApoio.edit', [
                'muralDeApoio' => $muralDeApoio
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o Mural de comunicação!');
            return redirect()->back();
        }
    }

    public function destroy(MuralDeComunicacaoFeed $muralDeComunicacaoFeed)
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar', 'mural de comunicacao.remove'])){
            return view('Admin.error.403');
        }
        Storage::delete($muralDeComunicacaoFeed->path_image);
        $muralDeComunicacaoFeed->delete();

        Session::flash('success','Mural de comunicação deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = MuralDeComunicacaoFeed::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            MuralDeComunicacaoFeed::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
