<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class MapController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('mapa.visualizar')) {
            return view('Admin.error.403');
        }
        $maps = Map::sorting()->get();

        return view('Admin.cruds.map.index', [
            'maps' => $maps
        ]);
    }

    public function create()
    {
        if (!Auth::user()->can(['mapa.visualizar','mapa.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.map.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;  
                Map::create($data);
            DB::commit();
            Session::flash('success','Mapa cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.map.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Session::flash('error','Erro ao cadastrar Mapa!');
            return redirect()->back();
        }
    }

    public function edit(Map $map)
    {
        if (!Auth::user()->can(['mapa.visualizar','mapa.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.map.edit', [
            'map' => $map
        ]);
    }

    public function update(Request $request, Map $map)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;  
                $map->fill($data)->save();
            DB::commit();
            Session::flash('success','Mapa atualizado com sucesso!');
            return redirect()->route('admin.dashboard.map.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Session::flash('error','Erro ao atualizar Mapa!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        if (!Auth::user()->can(['mapa.visualizar','mapa.remover'])) {
            return view('Admin.error.403');
        }
        $map->delete();
        Session::flash('success','Mapa deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['mapa.visualizar','mapa.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Map::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Map::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
