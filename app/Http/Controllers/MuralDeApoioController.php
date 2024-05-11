<?php

namespace App\Http\Controllers;

use App\Models\MuralDeApoio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MuralDeApoioController extends Controller
{

    public function index()
    {
        if(!Auth::user()->can('mural de comunicacao.visualizar')){
            return view('Admin.error.403');
        }
        $muralDeApoio = MuralDeApoio::first();

        return view('Admin.cruds.muralDeApoio.index', [
            'muralDeApoio' => $muralDeApoio
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.criar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.muralDeApoio.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                $muralDeApoio = MuralDeApoio::create($data);
            DB::commit();
            Session::flash('success', 'Informção cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.muralDeApoio.edit', [
                'muralDeApoio' => $muralDeApoio
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar Informção!');
            return redirect()->back();
        }
    }

    public function edit(MuralDeApoio $muralDeApoio)
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.editar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.muralDeApoio.edit', [
            'muralDeApoio' => $muralDeApoio
        ]);
    }

    public function update(Request $request, MuralDeApoio $muralDeApoio)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                $muralDeApoio->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Informção atualizada com sucesso!');
            return redirect()->route('admin.dashboard.muralDeApoio.edit', [
                'muralDeApoio' => $muralDeApoio
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar Informção!');
            return redirect()->back();
        }
    }

    public function destroy(MuralDeApoio $muralDeApoio)
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.remove'])){
            return view('Admin.error.403');
        }

        $muralDeApoio->delete();

        Session::flash('success','Informação deletada com sucesso!');
        return redirect()->back();
    }
}
