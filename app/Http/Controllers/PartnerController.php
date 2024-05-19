<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class PartnerController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/parceiros/';
    public function index()
    {
        if(!Auth::user()->can('parceiro.visualizar')){
            return view('Admin.error.403');
        }
        $partners = partner::sorting()->paginate();
        return view('Admin.cruds.partner.index', [
            'partners' => $partners
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['parceiro.visualizar','parceiro.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.partner.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
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

            $data['active'] = $request->active ? 1 : 0;

            if (!Partner::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }
            DB::commit();

            Session::flash('success', 'Parceiro cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.partner.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Parceiro!');
            return redirect()->back();
        }
    }

    public function edit(Partner $partner)
    {
        if (!Auth::user()->can(['parceiro.visualizar', 'parceiro.editar'])) {
            return view('Admin.error.403');
        }

        return view('Admin.cruds.partner.edit', [
            'partner' => $partner
        ]);
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                Storage::delete($partner->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($partner->$inputFile);
                $data['path_image'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $partner->fill($data)->save();

            //partner desktop
            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }

            DB::commit();
            Session::flash('success', 'Parceiro atualizado com sucesso!');
            return redirect()->route('admin.dashboard.partner.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o Parceiro!');
            return redirect()->back();
        }
    }

    public function destroy(Partner $partner)
    {
        if(!Auth::user()->can(['parceiro.visualizar', 'parceiro.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($partner->path_image);
        $partner->delete();

        Session::flash('success','partner deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['parceiro.visualizar','parceiro.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Partner::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Partner::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }

}
