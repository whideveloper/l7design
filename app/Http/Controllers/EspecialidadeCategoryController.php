<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EspecialidadeCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class EspecialidadeCategoryController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('especialidade.visualizar')){
            return view('Admin.error.403');
        }
        $especialidadeCategories = EspecialidadeCategory::sorting()->get();

        return view('Admin.cruds.especialidadeCategory.index', [
            'especialidadeCategories' => $especialidadeCategories
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['especialidade.visualizar','especialidade.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.especialidadeCategory.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;

            EspecialidadeCategory::create($data);

            Session::flash('success', 'Categoria cadastrada com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.especialidadeCategory.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o categoria!');
            return redirect()->back();
        }
    }

    public function edit(EspecialidadeCategory $especialidadeCategory)
    {
        if (!Auth::user()->can(['especialidade.visualizar', 'especialidade.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.especialidadeCategory.edit', [
            'especialidadeCategory' => $especialidadeCategory
        ]);
    }

    public function update(Request $request, EspecialidadeCategory $especialidadeCategory)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;

            $especialidadeCategory->fill($data)->save();

            DB::commit();
            Session::flash('success', 'Categoria atualizada com sucesso!');
            return redirect()->route('admin.dashboard.especialidadeCategory.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o categoria!');
            return redirect()->back();
        }
    }

    public function destroy(EspecialidadeCategory $especialidadeCategory)
    {
        if(!Auth::user()->can(['especialidade.visualizar', 'especialidade.remover'])){
            return view('Admin.error.403');
        }
        
        $especialidadeCategory->delete();

        Session::flash('success','Categoria deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['especialidade.visualizar','especialidade.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = EspecialidadeCategory::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            EspecialidadeCategory::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
