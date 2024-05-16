<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class MaterialDocumentController extends Controller
{
    protected $pathUpload = 'admin/uploads/files/doumento-de-material-de-apoio/';
    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {
                $data['path_file'] = $this->pathUpload . $path_file;
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }

            $data['active'] = $request->active ? 1 : 0;

            
            if (!MaterialDocument::create($data)) {
                Storage::delete($this->pathUpload . $path_file);
                throw new Exception();
            }

            Session::flash('success', 'Arquivo cadastrado com sucesso!');

            DB::commit();
            return redirect()->back();
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Arquivo!');
            return redirect()->back();
        }
    }

    public function update(Request $request, MaterialDocument $materialDocument)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {
                $data['path_file'] = $this->pathUpload . $path_file;
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
                Storage::delete($materialDocument->path_file);
            }
            if(isset($request->delete_path_file) && !$path_file){
                $inputFile = $request->delete_path_file;
                Storage::delete($materialDocument->$inputFile);
                $data['path_file'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $materialDocument->fill($data)->save();

            if ($path_file) {
                Storage::delete($this->pathUpload . $path_file);
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }
            
            DB::commit();
            Session::flash('success', 'Arquivo atualizada com sucesso!');
            return redirect()->back();
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar Arquivo!');
            return redirect()->back();
        }
    }


    public function destroy(MaterialDocument $materialDocument)
    {
        if(!Auth::user()->can(['material de apoio.visualizar', 'material de apoio.remove'])){
            return view('Admin.error.403');
        }
        Storage::delete($materialDocument->path_file);
        $materialDocument->delete();

        Session::flash('success','Arquivo deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['material de apoio.visualizar','material de apoio.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = MaterialDocument::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            MaterialDocument::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
