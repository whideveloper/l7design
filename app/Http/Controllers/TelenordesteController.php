<?php

namespace App\Http\Controllers;

use App\Models\Telenordeste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class TelenordesteController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('telenordeste.visualizar')){
            return view('Admin.error.403');
        }
        $telenordeste = Telenordeste::first();
        return view('Admin.cruds.telenordeste.index', [
            'telenordeste' => $telenordeste
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['telenordeste.visualizar','telenordeste.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.telenordeste.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                Telenordeste::create($data);
            DB::commit();
            Session::flash('success','Telenordeste criado com sucesso!');
            return redirect()->route('admin.dashboard.telenordeste.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('success','Erro ao criar Telenordeste!');
                return redirect()->back();
        }
    }

    public function edit(Telenordeste $telenordeste)
    {
        if(!Auth::user()->can(['telenordeste.visualizar','telenordeste.editar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.telenordeste.edit', [
            'telenordeste' => $telenordeste
        ]);
    }

    public function update(Request $request, Telenordeste $telenordeste)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                $telenordeste->fill($data)->save();
            DB::commit();
            Session::flash('success','Telenordeste atualizado com sucesso!');
            return redirect()->route('admin.dashboard.telenordeste.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('success','Erro ao atualizar Telenordeste!');
                return redirect()->back();
        }
    }

    public function destroy(Telenordeste $telenordeste)
    {
        if(!Auth::user()->can(['telenordeste.visualizar','telenordeste.remover'])){
            return view('Admin.error.403');
        }

        $telenordeste->delete();
        Session::flash('success','telenordeste deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['telenordeste.visualizar','telenordeste.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Telenordeste::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Telenordeste::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
