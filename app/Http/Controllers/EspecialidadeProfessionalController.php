<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EspecialidadeSession;
use Illuminate\Support\Facades\Auth;
use App\Models\EspecialidadeCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\EspecialidadeProfessional;
use App\Http\Controllers\Helpers\HelperArchive;

class EspecialidadeProfessionalController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/especialista/';

    public function create(){
        if(!Auth::user()->can(['especialidade.visualizar', 'especialidade.criar'])){
            return view('Admin.error.403');
        }
        $categoryTitle = [];
        $categoryEspecialidade = EspecialidadeCategory::active()->get();
        foreach($categoryEspecialidade as $title){
            $categoryTitle[$title->id] = $title->title;
        }
        $especialidadeSession = EspecialidadeSession::first();
        return view('Admin.cruds.especialidadeProfessional.create', [
            'categoryEspecialidade' => $categoryTitle,
            'especialidadeSession' => $especialidadeSession,
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

            if (!EspecialidadeProfessional::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }
            $especialidadeSession = EspecialidadeSession::first();

            DB::commit();
            
            Session::flash('success', 'Especialista cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.especialidadeSession.edit', [
                'especialidadeSession' => $especialidadeSession
            ]);
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o especialista!');
            return redirect()->back();
        }
    }

    public function edit(Request $request, EspecialidadeProfessional $especialidadeProfessional){
        if(!Auth::user()->can(['especialidade.visualizar', 'especialidade.editar'])){
            return view('Admin.error.403');
        }
        $categoryTitle = [];
        $categoryEspecialidade = EspecialidadeCategory::active()->get();
        foreach($categoryEspecialidade as $title){
            $categoryTitle[$title->id] = $title->title;
        }
        $especialidadeSession = EspecialidadeSession::first();

        return view('Admin.cruds.especialidadeProfessional.edit', [
            'especialidadeProfessional' => $especialidadeProfessional,
            'categoryEspecialidade' => $categoryTitle,
            'title' => $request->title??null,
            'especialidadeSession' => $especialidadeSession
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
            Session::flash('success', 'Especialista atualizada com sucesso!');
            return redirect()->route('admin.dashboard.especialidadeSession.edit', [
                'especialidadeSession' => $especialidadeSession
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o especialista!');
            return redirect()->back();
        }
    }

    public function destroy(EspecialidadeProfessional $especialidadeProfessional)
    {
        if(!Auth::user()->can(['especialidade.visualizar', 'especialidade.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($especialidadeProfessional->path_image);
        $especialidadeProfessional->delete();

        Session::flash('success','Especialista deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['especialidade.visualizar','especialidade.remover'])) {
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
