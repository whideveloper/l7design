<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EspecialidadeSession;
use Illuminate\Support\Facades\Auth;
use App\Models\EspecialidadeCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\EspecialidadeProfessional;

class EspecialidadeSessionController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('especialidade.visualizar')){
            return view('Admin.error.403');
        }
        
        $especialidadeSession = EspecialidadeSession::first();

        return view('Admin.cruds.especialidadeSession.index', [
            'especialidadeSession' => $especialidadeSession,            
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['especialidade.visualizar','especialidade.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.especialidadeSession.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $data['active'] = $request->active ? 1 : 0;

            $especialidadeSession = EspecialidadeSession::create($data);

            Session::flash('success', 'Informação cadastrada com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.especialidadeSession.edit', ['especialidadeSession' => $especialidadeSession->id]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar Informação!');
            return redirect()->back();
        }
    }
    public function edit(EspecialidadeSession $especialidadeSession, Request $request)
    {
        if (!Auth::user()->can(['especialidade.visualizar', 'especialidade.editar'])) {
            return view('Admin.error.403');
        }
        $categoryTitle = [];
        $categoryEspecialidade = EspecialidadeCategory::active()->get();
        foreach($categoryEspecialidade as $title){
            $categoryTitle[$title->id] = $title->title;
        }
        $especialidadeProfessionals = EspecialidadeProfessional::join('especialidade_categories', 'especialidade_professionals.especialidade_category_id', 'especialidade_categories.id')
        ->select(
            'especialidade_categories.id as category_id', 
            'especialidade_categories.title as categoria',
            'especialidade_categories.sorting as categoria_sorting',
            'especialidade_professionals.name',
            'especialidade_professionals.path_image',
            'especialidade_professionals.active',
            'especialidade_professionals.id as especialidade_id',
            'especialidade_professionals.sorting',
            )->sorting()->paginate(10);
        return view('Admin.cruds.especialidadeSession.edit', [
            'especialidadeSession' => $especialidadeSession,
            'especialidadeProfessionals' => $especialidadeProfessionals,
            'categoryEspecialidade' => $categoryTitle,
            'title' => $request->title??null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EspecialidadeSession  $especialidadeSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EspecialidadeSession $especialidadeSession)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $data['active'] = $request->active ? 1 : 0;

            $especialidadeSession->fill($data)->save();

            DB::commit();
            Session::flash('success', 'Informação atualizada com sucesso!');
            return redirect()->route('admin.dashboard.especialidadeSession.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o categoria!');
            return redirect()->back();
        }
    }

    public function destroy(EspecialidadeSession $especialidadeSession)
    {
        if(!Auth::user()->can(['especialidade.visualizar', 'especialidade.remove'])){
            return view('Admin.error.403');
        }
        
        $especialidadeSession->delete();

        Session::flash('success','Informação deletada com sucesso!');
        return redirect()->back();
    }
}
