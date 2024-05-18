<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ContactTelenordeste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class ContactTelenordesteController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/contato-telenordeste/';
    public function index()
    {   
        if (!Auth::user()->can('contato.visualizar')) {
            return view('Admin.error.403');
        }
        $contactTelenordeste = ContactTelenordeste::sorting()->get();

        return view('Admin.cruds.contactTelenordeste.index', [
            'contactTelenordestes' => $contactTelenordeste
        ]);
    }
    public function create()
    {
        if (!Auth::user()->can(['contato.visualizar','contato.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.contactTelenordeste.create');
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
                $data['active'] = $request->active?1:0;

                if (!ContactTelenordeste::create($data)) {
                    Storage::delete($this->pathUpload . $path_image);
                    throw new Exception();
                }
            DB::commit();

            Session::flash('success', 'Contato criado com sucesso!');
            return redirect()->route('admin.dashboard.contactTelenordeste.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar contato!');
            return redirect()->back();
        }
    }
    public function edit(ContactTelenordeste $contactTelenordeste)
    {
        if (!Auth::user()->can(['contato.visualizar','contato.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.contactTelenordeste.edit', [
            'contactTelenordeste' => $contactTelenordeste
        ]);
    }

    public function update(Request $request, ContactTelenordeste $contactTelenordeste)
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
                    Storage::delete($contactTelenordeste->path_image);
                }
                if(isset($request->delete_path_image) && !$path_image){
                    $inputFile = $request->delete_path_image;
                    Storage::delete($contactTelenordeste->$inputFile);
                    $data['path_image'] = null;
                }
                $data['active'] = $request->active?1:0;

                $contactTelenordeste->fill($data)->save();

                if ($path_image) {
                    Storage::delete($this->pathUpload . $path_image);
                }
                if ($path_image) {
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }
            DB::commit();
            Session::flash('success', 'Contato atualizado com sucesso!');
            return redirect()->route('admin.dashboard.contactTelenordeste.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar contato!');
            return redirect()->back();
        }
    }

    public function destroy(ContactTelenordeste $contactTelenordeste)
    {
        if(!Auth::user()->can(['contato.visualizar', 'contato.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($contactTelenordeste->path_image);
        $contactTelenordeste->delete();

        Session::flash('success','Contato deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['contato.visualizar','contato.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = ContactTelenordeste::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            ContactTelenordeste::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
