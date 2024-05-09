<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\EspecialidadeProfessional;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\EspecialidadeSession;

class EspecialidadeProfessionalController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/categoria-especialidade/';

    public function create()
    {
        if(!Auth::user()->can(['especialidade.visualizar','especialidade.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.especialidadeProfessional.create');
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

            $especialidadeSession = EspecialidadeSession::first();

            EspecialidadeProfessional::create($data);

            // if (!EspecialidadeProfessional::create($data)) {
            //     Storage::delete($this->pathUpload . $path_image);
            //     throw new Exception();
            // }

            Session::flash('success', 'Especialidade cadastrado com sucesso!');

            DB::commit();
            return redirect()->route('Admin.cruds.especialidadeSession.index', [
                'especialidadeSession' => $especialidadeSession
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o categoria!');
            return redirect()->back();
        }
    }

    public function edit(EspecialidadeProfessional $especialidadeProfessional)
    {
        if (!Auth::user()->can(['especialidade.visualizar', 'especialidade.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.especialidadeProfessional.edit', [
            'especialidadeProfessional' => $especialidadeProfessional
        ]);
    }

    public function update(Request $request, EspecialidadeProfessional $especialidadeProfessional)
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
                Storage::delete($especialidadeProfessional->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($especialidadeProfessional->$inputFile);
                $data['path_image'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $especialidadeProfessional->fill($data)->save();

            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            $especialidadeSession = EspecialidadeSession::first();
            DB::commit();
            Session::flash('success', 'Especialidade atualizada com sucesso!');
            return redirect()->route('Admin.cruds.especialidadeSession.index', [
                'especialidadeSession' => $especialidadeSession
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o categoria!');
            return redirect()->back();
        }
    }

    public function destroy(EspecialidadeProfessional $especialidadeProfessional)
    {
        if(!Auth::user()->can(['especialidade.visualizar', 'especialidade.remove'])){
            return view('Admin.error.403');
        }
        
        $especialidadeProfessional->delete();

        Session::flash('success','Especialidade deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['especialidade.visualizar','especialidade.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = EspecialidadeProfessional::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            EspecialidadeProfessional::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
