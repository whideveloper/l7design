<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AgendamentoController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can(['agendamento.visualizar', 'agendamento.editar'])) {
            return view('Admin.error.403');
        }
        $agendamento = Agendamento::first();
        return view('Admin.cruds.agendamento.index', [
            'agendamento' => $agendamento
        ]);
    }
    public function create()
    {
        if (!Auth::user()->can(['agendamento.visualizar', 'agendamento.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.agendamento.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;
        try {
            DB::beginTransaction();
                Agendamento::create($data);
            DB::commit();

            Session::flash('success', 'Agendamento cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.agendamento.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o agendamento!');
            return redirect()->back();
        }
    }

    public function edit(Agendamento $agendamento)
    {
        if (!Auth::user()->can(['agendamento.visualizar', 'agendamento.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.agendamento.edit', [
            'agendamento' => $agendamento
        ]);
    }


    public function update(Request $request, Agendamento $agendamento)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;
        try {
            DB::beginTransaction();
                $agendamento->fill($data)->save();
            DB::commit();

            Session::flash('success', 'Agendamento atualizado com sucesso!');
            return redirect()->route('admin.dashboard.agendamento.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o agendamento!');
            return redirect()->back();
        }
    }


    public function destroy(Agendamento $agendamento)
    {
        if (!Auth::user()->can(['agendamento.visualizar', 'agendamento.remover'])) {
            return view('Admin.error.403');
        }
        $agendamento->delete();
        return redirect()->back();
        Session::flash('success', 'Agendamento deletado com sucesso!');
    }
}
