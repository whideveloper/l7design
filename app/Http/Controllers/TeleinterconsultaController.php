<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Teleinterconsulta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Http\Requests\TeleinterconsultaStoreRequest;
use App\Http\Requests\TeleinterconsultaUpdateRequest;

class TeleinterconsultaController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/teleInterconsulta/';
    public function index()
    {
        if (!Auth::user()->can('teleinterconsulta.visualizar')) {
            return view('Admin.error.403');
        }
        $teleinterconsulta = Teleinterconsulta::sorting()->first();
        return view('Admin.cruds.teleinterconsulta.index',[
            'teleinterconsulta' => $teleinterconsulta
        ]);
    }


    public function create()
    {
        if (!Auth::user()->can(['teleinterconsulta.visualizar','teleinterconsulta.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.teleinterconsulta.create');
    }

    public function store(TeleinterconsultaStoreRequest $request)
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

            if (!Teleinterconsulta::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }
            DB::commit();
            Session::flash('success', 'Teleinterconsulta cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.teleinterconsulta.index');
        }catch(\Exception $exception){
            DB::rollback();
            Session::flash('error', 'Erro ao cadastrar Teleinterconsulta!');
            return redirect()->back();
        }
    }
    public function edit(Teleinterconsulta $teleinterconsulta)
    {
        if (!Auth::user()->can(['teleinterconsulta.visualizar','teleinterconsulta.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.teleinterconsulta.edit',[
            'teleinterconsulta' => $teleinterconsulta
        ]);
    }
    public function update(TeleinterconsultaUpdateRequest $request, Teleinterconsulta $teleinterconsulta)
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
                Storage::delete($teleinterconsulta->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($teleinterconsulta->$inputFile);
                $data['path_image'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $teleinterconsulta->fill($data)->save();
            
            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            DB::commit();
            Session::flash('success', 'Teleinterconsulta cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.teleinterconsulta.index');
        }catch(\Exception $exception){
            DB::rollback();
            Session::flash('error', 'Erro ao cadastrar Teleinterconsulta!');
            return redirect()->back();
        }
    }
    public function destroy(Teleinterconsulta $Teleinterconsulta)
    {
        if (!Auth::user()->can(['teleinterconsulta.visualizar','teleinterconsulta.remove'])) {
            return view('Admin.error.403');
        }
        Storage::delete($Teleinterconsulta->path_image);
        $Teleinterconsulta->delete();
        Session::flash('success', 'Teleinterconsulta deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['teleinterconsulta.visualizar','teleinterconsulta.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Teleinterconsulta::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Teleinterconsulta::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
