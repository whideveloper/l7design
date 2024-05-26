<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\SavGravada;

class SavController extends Controller
{
    protected $pathUpload = 'admin/uploads/files/sav/';
    protected $pathUploadImage = 'admin/uploads/images/sav/';
    public function index()
    {
        if(!Auth::user()->can('sav.visualizar')){
            return view('Admin.error.403');
        }
        $sav = Sav::first();

        return view('Admin.cruds.sav.index', [
            'sav' => $sav
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['sav.visualizar','sav.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.sav.create');
    }

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

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUploadImage . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUploadImage, $path_image);
            }
            
            if (!$sav = Sav::create($data)) {
                Storage::delete($this->pathUpload . $path_file);
                Storage::delete($this->pathUploadImage . $path_image);
                throw new Exception();
            }

            Session::flash('success', 'Sav cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.sav.edit', [
                'sav' => $sav
            ]);
            DB::commit();
            return redirect()->route('admin.dashboard.sav.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Sav!');
            return redirect()->back();
        }
    }

    public function edit(Sav $sav)
    {
        if(!Auth::user()->can(['sav.visualizar','sav.editar'])){
            return view('Admin.error.403');
        }
        $savGravadas = SavGravada::sorting()->paginate(50);
        
        return view('Admin.cruds.sav.edit', [
            'sav' => $sav,
            'savGravadas' => $savGravadas,
        ]);
    }
    public function update(Request $request, Sav $sav)
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
                Storage::delete($sav->path_file);
            }
            if(isset($request->delete_path_file) && !$path_file){
                $inputFile = $request->delete_path_file;
                Storage::delete($sav->$inputFile);
                $data['path_file'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUploadImage . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUploadImage, $path_image);
                Storage::delete($sav->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($sav->$inputFile);
                $data['path_image'] = null;
            }

            $sav->fill($data)->save();

            if ($path_file) {
                Storage::delete($this->pathUpload . $path_file);
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }
            if ($path_image) {
                Storage::delete($this->pathUploadImage . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUploadImage, $path_image);
            }

            DB::commit();
            Session::flash('success', 'Sav atualizado com sucesso!');
            return redirect()->route('admin.dashboard.sav.edit', [
                'sav' => $sav
            ]);
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar Sav!');
            return redirect()->back();
        }
    }

    public function destroy(Sav $sav)
    {
        if(!Auth::user()->can(['sav.visualizar', 'sav.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($sav->path_file);
        Storage::delete($sav->path_image);
        $sav->delete();

        Session::flash('success','Sav deletada com sucesso!');
        return redirect()->back();
    }
}
