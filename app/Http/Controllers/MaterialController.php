<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MaterialDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class MaterialController extends Controller
{

    public function index()
    {
        if(!Auth::user()->can('material.visualizar')){
            return view('Admin.error.403');
        }
        $materials = Material::sorting()->get();
        return view('Admin.cruds.material.index', [
            'materials' => $materials
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['material.visualizar','material.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.material.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title,'-','pt-BR');
        $data['active'] = $request->active?1:0;
        try {
            DB::beginTransaction();
                $material = Material::create($data);
            DB::commit();

            Session::flash('success', 'Informação cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.material.edit', [
                'material' => $material
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o informação!');
            return redirect()->back();
        }
    }

    public function edit(Material $material)
    {
        if(!Auth::user()->can(['material.visualizar','material.editar'])){
            return view('Admin.error.403');
        }
        
        return view('Admin.cruds.material.edit', [
            'material' => $material
        ]);
    }

    public function update(Request $request, Material $material)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title,'-','pt-BR');
        $data['active'] = $request->active?1:0;
        try {
            DB::beginTransaction();
                $material->fill($data)->save();
            DB::commit();

            Session::flash('success', 'Informação atualizada com sucesso!');
            return redirect()->route('admin.dashboard.material.edit', [
                'material' => $material
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar informação!');
            return redirect()->back();
        }
    }


    public function destroy(Material $material)
    {
        if(!Auth::user()->can(['material.visualizar', 'material.remove'])){
            return view('Admin.error.403');
        }
        
        $material->delete();

        Session::flash('success','Informação deletada com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['material.visualizar','material.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Material::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Material::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
