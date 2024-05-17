<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sav;
use App\Models\SavGravada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class SavGravadaController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/sav-gravadas/';
    public function create()
    {
        if(!Auth::user()->can('sav.visualizar')){
            return view('Admin.error.403');
        }
        $sav = Sav::first();
        return view('Admin.cruds.savGravada.create', [
            'sav' => $sav
        ]);
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

            $sav = Sav::first();

            if (!SavGravada::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }

            Session::flash('success', 'Savs gravadas cadastrado com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.sav.edit', [
                'sav' => $sav
            ]);
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar Savs gravadas!');
            return redirect()->back();
        }
    }
    public function edit(SavGravada $savGravada)
    {
        if(!Auth::user()->can('sav.visualizar')){
            return view('Admin.error.403');
        }
        $sav = Sav::first();
        
        return view('Admin.cruds.savGravada.edit', [
            'savGravada' => $savGravada,
            'sav' => $sav,
        ]);
    }
    public function update(Request $request, SavGravada $savGravada)
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
                Storage::delete($savGravada->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($savGravada->$inputFile);
                $data['path_image'] = null;
            }
            $data['active'] = $request->active ? 1 : 0;
            
            $savGravada->fill($data)->save();
            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            
            $sav = Sav::first();
            DB::commit();
            Session::flash('success', 'Savs gravadas atualizada com sucesso!');
            return redirect()->route('admin.dashboard.sav.edit', [
                'sav' => $sav
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o Savs gravadas!');
            return redirect()->back();
        }
    }

    public function destroy(SavGravada $savGravada)
    {
        if(!Auth::user()->can(['sav.visualizar', 'sav.remove'])){
            return view('Admin.error.403');
        }
        Storage::delete($savGravada->path_image);
        $savGravada->delete();

        Session::flash('success','Savs gravadas deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['sav.visualizar','sav.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = SavGravada::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            SavGravada::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
