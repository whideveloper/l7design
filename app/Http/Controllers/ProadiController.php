<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Proadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Http\Requests\ProadiStoreRequest;
use App\Http\Requests\ProadiUpdateRequest;

class ProadiController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/proadi/';
    public function index()
    {
        if(!Auth::user()->can('proadi.visualizar')){
            return view('Admin.error.403');
        }
        $proadi = Proadi::first();

        return view('Admin.cruds.proadi.index', [
            'proadi' => $proadi
        ]);
    }
    public function create()
    {
        if(!Auth::user()->can(['proadi.visualizar','proadi.criar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.proadi.create');
    }
    public function store(ProadiStoreRequest $request)
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

            if (!Proadi::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }

            Session::flash('success', 'Proadi cadastrado com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.proadi.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Proadi!');
            return redirect()->back();
        }
    }
    public function edit(Proadi $proadi)
    {
        if(!Auth::user()->can(['proadi.visualizar','proadi.editar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.proadi.edit', [
            'proadi' => $proadi
        ]);
    }
    public function update(ProadiUpdateRequest $request, Proadi $proadi)
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
                Storage::delete($proadi->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($proadi->$inputFile);
                $data['path_image'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $proadi->fill($data)->save();

            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            DB::commit();
            Session::flash('success', 'proadi atualizado com sucesso!');
            return redirect()->route('admin.dashboard.proadi.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o proadi!');
            return redirect()->back();
        }
    }

    public function destroy(Proadi $proadi)
    {
        if(!Auth::user()->can(['proadi.visualizar','proadi.remove'])){
            return view('Admin.error.403');
        }
        Storage::delete($proadi->path_image);
        $proadi->delete();

        Session::flash('success','proadi deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['proadi.visualizar','proadi.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Proadi::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }
}
