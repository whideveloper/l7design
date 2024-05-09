<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingForUse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TrainingForUseController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('treinamento.visualizar')){
            return view('Admin.error.403');
        }
        $trainingForUse = TrainingForUse::first();
        return view('Admin.cruds.trainingForUse.index', [
            'trainingForUse' => $trainingForUse
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['treinamento.visualizar','treinamento.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.trainingForUse.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;
        try {
            DB::beginTransaction();
                $trainingForUse = TrainingForUse::create($data);
            DB::commit();

            Session::flash('success', 'Informação cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.trainingForUse.edit', [
                'trainingForUse' => $trainingForUse
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o informação!');
            return redirect()->back();
        }
    }

    public function edit(TrainingForUse $trainingForUse)
    {
        if(!Auth::user()->can(['treinamento.visualizar','treinamento.editar'])){
            return view('Admin.error.403');
        }
        $trainings = Training::sorting()->get();
        return view('Admin.cruds.trainingForUse.edit', [
            'trainingForUse' => $trainingForUse,
            'trainings' => $trainings
        ]);
    }


    public function update(Request $request, TrainingForUse $trainingForUse)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;
        try {
            DB::beginTransaction();
                $trainingForUse->fill($data)->save();
            DB::commit();

            Session::flash('success', 'Informação atualizada com sucesso!');
            return redirect()->route('admin.dashboard.trainingForUse.edit', [
                'trainingForUse' => $trainingForUse
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar informação!');
            return redirect()->back();
        }
    }

    public function destroy(TrainingForUse $trainingForUse)
    {
        if(!Auth::user()->can(['treinamento.visualizar', 'treinamento.remove'])){
            return view('Admin.error.403');
        }
        
        $trainingForUse->delete();

        Session::flash('success','Informação deletada com sucesso!');
        return redirect()->back();
    }
}
