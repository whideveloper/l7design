<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Helpers\HelperArchive;

class TutorialController extends Controller
{
    protected $pathUpload = 'admin/uploads/files/tutorial/';
    public function index()
    {
        if(!Auth::user()->can('tutorial.visualizar')){
            return view('Admin.error.403');
        }
        $tutorial = Tutorial::first();
        return view('Admin.cruds.tutorial.index', [
            'tutorial' => $tutorial
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['tutorial.visualizar','tutorial.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.tutorial.create');
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

            
            if (!Tutorial::create($data)) {
                Storage::delete($this->pathUpload . $path_file);
                throw new Exception();
            }

            DB::commit();
            
            Session::flash('success', 'Tutorial cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.tutorial.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o tutorial!');
            return redirect()->back();
        }
    }

    public function edit(Tutorial $tutorial)
    {
        if(!Auth::user()->can(['tutorial.visualizar','tutorial.editar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.tutorial.edit', [
            'tutorial' => $tutorial
        ]);
    }

    public function update(Request $request, Tutorial $tutorial)
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
                Storage::delete($tutorial->path_file);
            }
            if(isset($request->delete_path_file) && !$path_file){
                $inputFile = $request->delete_path_file;
                Storage::delete($tutorial->$inputFile);
                $data['path_file'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $tutorial->fill($data)->save();

            if ($path_file) {
                Storage::delete($this->pathUpload . $path_file);
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }

            DB::commit();
            Session::flash('success', 'Tutorial atualizado com sucesso!');
            return redirect()->route('admin.dashboard.tutorial.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o categoria!');
            return redirect()->back();
        }
    }

    public function destroy(Tutorial $tutorial)
    {
        if(!Auth::user()->can(['tutorial.visualizar', 'tutorial.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($tutorial->path_file);
        $tutorial->delete();

        Session::flash('success','Tutorial deletado com sucesso!');
        return redirect()->back();
    }
}
