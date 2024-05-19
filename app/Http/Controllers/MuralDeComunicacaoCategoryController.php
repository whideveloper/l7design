<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\MuralDeComunicacaoCategory;

class MuralDeComunicacaoCategoryController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('mural de comunicacao.visualizar')){
            return view('Admin.error.403');
        }
        $muralDeComunicacaoCategories = MuralDeComunicacaoCategory::sorting()->get();

        return view('Admin.cruds.muralDeComunicacaoCategory.index', [
            'muralDeComunicacaoCategories' => $muralDeComunicacaoCategories
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.muralDeComunicacaoCategory.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title,'-','pt-BR');
        $data['active'] = $request->active ? 1 : 0;

        try {
            DB::beginTransaction();

            MuralDeComunicacaoCategory::create($data);

            Session::flash('success', 'Categoria cadastrada com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.muralDeComunicacaoCategory.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o categoria!');
            return redirect()->back();
        }
    }

    public function edit(MuralDeComunicacaoCategory $muralDeComunicacaoCategory)
    {
        if (!Auth::user()->can(['mural de comunicacao.visualizar', 'mural de comunicacao.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.muralDeComunicacaoCategory.edit', [
            'muralDeComunicacaoCategory' => $muralDeComunicacaoCategory
        ]);
    }

    public function update(Request $request, MuralDeComunicacaoCategory $muralDeComunicacaoCategory)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;

            $muralDeComunicacaoCategory->fill($data)->save();

            DB::commit();
            Session::flash('success', 'Categoria atualizada com sucesso!');
            return redirect()->route('admin.dashboard.muralDeComunicacaoCategory.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o categoria!');
            return redirect()->back();
        }
    }


    public function destroy(MuralDeComunicacaoCategory $muralDeComunicacaoCategory)
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar', 'mural de comunicacao.remover'])){
            return view('Admin.error.403');
        }
        
        $muralDeComunicacaoCategory->delete();

        Session::flash('success','Categoria deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = MuralDeComunicacaoCategory::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            MuralDeComunicacaoCategory::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
