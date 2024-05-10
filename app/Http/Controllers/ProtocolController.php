<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Protocol;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Helpers\HelperArchive;

class ProtocolController extends Controller
{
    protected $pathUpload = 'admin/uploads/files/protocolo/';
    protected $pathUploadImage = 'admin/uploads/images/protocolo/';
    public function index()
    {
        if(!Auth::user()->can('protocolo.visualizar')){
            return view('Admin.error.403');
        }
        $protocol = Protocol::first();

        return view('Admin.cruds.protocol.index', [
            'protocol' => $protocol
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('protocolo.visualizar')){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.protocol.create');
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
            $data['slug'] = Str::slug($request->title,'-','pt-BR');

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUploadImage . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUploadImage, $path_image);
            }
            
            if (!Protocol::create($data)) {
                Storage::delete($this->pathUpload . $path_file);
                Storage::delete($this->pathUploadImage . $path_image);
                throw new Exception();
            }

            Session::flash('success', 'Protocolo cadastrada com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.protocol.index');
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Protocolo!');
            return redirect()->back();
        }
    }
    public function edit(Protocol $protocol)
    {
        if(!Auth::user()->can(['protocolo.visualizar','protocolo.editar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.protocol.edit', [
            'protocol' => $protocol
        ]);
    }

    public function update(Request $request, Protocol $protocol)
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
                Storage::delete($protocol->path_file);
            }
            if(isset($request->delete_path_file) && !$path_file){
                $inputFile = $request->delete_path_file;
                Storage::delete($protocol->$inputFile);
                $data['path_file'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;
            $data['slug'] = Str::slug($request->title,'-','pt-BR');

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUploadImage . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUploadImage, $path_image);
                Storage::delete($protocol->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($protocol->$inputFile);
                $data['path_image'] = null;
            }

            $protocol->fill($data)->save();

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
            Session::flash('success', 'Protocolo atualizado com sucesso!');
            return redirect()->route('admin.dashboard.protocol.index');
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar Protocolo!');
            return redirect()->back();
        }
    }


    public function destroy(Protocol $protocol)
    {
        if(!Auth::user()->can(['protocolo.visualizar', 'protocolo.remove'])){
            return view('Admin.error.403');
        }
        Storage::delete($protocol->path_file);
        Storage::delete($protocol->path_image);
        $protocol->delete();

        Session::flash('success','Protocolo deletada com sucesso!');
        return redirect()->back();
    }
}
