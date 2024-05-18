<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Http\Requests\HospitalStoreRequest;
use App\Http\Requests\HospitalUpdateRequest;

class HospitalController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/hospital-oswaldo-cruz/';
    public function index()
    {
        if(!Auth::user()->can('hospital.visualizar')){
            return view('Admin.error.403');
        }
        $hospital = Hospital::first();

        return view('Admin.cruds.hospital.index', [
            'hospital' => $hospital
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['hospital.visualizar','hospital.criar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.hospital.create');
    }

    public function store(HospitalStoreRequest $request)
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

            $path_image_logo = $helper->renameArchiveUpload($request, 'path_image_logo');
            if ($path_image_logo) {
                $data['path_image_logo'] = $this->pathUpload . $path_image_logo;
            }
            if ($path_image_logo) {
                $request->file('path_image_logo')->storeAs($this->pathUpload, $path_image_logo);
            }
            if (!Hospital::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                Storage::delete($this->pathUpload . $path_image_logo);
                throw new Exception();
            }

            Session::flash('success', 'Hospital cadastrado com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.hospital.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Hospital!');
            return redirect()->back();
        }

    }
    public function edit(Hospital $hospital)
    {
        if(!Auth::user()->can(['hospital.visualizar','hospital.editar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.hospital.edit', [
            'hospital' => $hospital
        ]);
    }
    
    public function update(HospitalUpdateRequest $request, Hospital $hospital)
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
                Storage::delete($hospital->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($hospital->$inputFile);
                $data['path_image'] = null;
            }

            $path_image_logo = $helper->renameArchiveUpload($request, 'path_image_logo');
            if ($path_image_logo) {
                $data['path_image_logo'] = $this->pathUpload . $path_image_logo;
            }
            if ($path_image_logo) {
                $request->file('path_image_logo')->storeAs($this->pathUpload, $path_image_logo);
                Storage::delete($hospital->path_image_logo);
            }
            if(isset($request->delete_path_image_logo) && !$path_image_logo){
                $inputFile = $request->delete_path_image_logo;
                Storage::delete($hospital->$inputFile);
                $data['path_image_logo'] = null;
            }
            $data['active'] = $request->active ? 1 : 0;

            $hospital->fill($data)->save();

            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }

            if ($path_image_logo) {
                Storage::delete($this->pathUpload . $path_image_logo);
            }
            if ($path_image_logo) {
                $request->file('path_image_logo')->storeAs($this->pathUpload, $path_image_logo);
            }
            DB::commit();
            Session::flash('success', 'Hospital atualizado com sucesso!');
            return redirect()->route('admin.dashboard.hospital.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o hospital!');
            return redirect()->back();
        }
    }

    public function destroy(Hospital $hospital)
    {
        if(!Auth::user()->can(['hospital.visualizar','hospital.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($hospital->path_image);
        Storage::delete($hospital->path_image_logo);
        $hospital->delete();

        Session::flash('success','Hospital deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['hospital.visualizar','hospital.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Hospital::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }
}
