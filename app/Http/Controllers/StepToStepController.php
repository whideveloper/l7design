<?php

namespace App\Http\Controllers;

use App\Models\StepToStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StepToStepStoreRequest;
use App\Http\Requests\StepToStepUpdateRequest;
use App\Models\HowItWork;

class StepToStepController extends Controller
{    
    public function create()
    {
        if (!Auth::user()->can(['passo a passo.visualizar','passo a passo.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.stepToStep.create');
    }
    public function store(StepToStepStoreRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['active'] = $request->active ? 1 : 0;
            StepToStep::create($data);
            $howItWork = HowItWork::first();
            DB::commit();
            Session::flash('success', 'Passo a passo criado com sucesso!');
            return redirect()->route('admin.dashboard.howItWork.edit',['howItWork'=>$howItWork->id]);
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', 'Erro ao criar Passo a passo!');
            return redirect()->back();
        }
    }
    public function edit(StepToStep $stepToStep)
    {
        if (!Auth::user()->can(['passo a passo.visualizar','passo a passo.editar'])) {
            return view('Admin.error.403');
        }
        $howItWork = HowItWork::first();
        return view('Admin.cruds.stepToStep.edit', [
            'stepToStep' => $stepToStep,
            'howItWork' => $howItWork,
        ]);
    }
    public function update(StepToStepUpdateRequest $request, StepToStep $stepToStep)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['active'] = $request->active ? 1 : 0;
            $stepToStep->fill($data)->save();
            $howItWork = HowItWork::first();
            DB::commit();
            Session::flash('success', 'Passo a passo atualizado com sucesso!');
            return redirect()->route('admin.dashboard.howItWork.edit',['howItWork'=>$howItWork->id]);
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar Passo a passo!');
            return redirect()->back();
        }
    }
    public function destroy(StepToStep $stepToStep)
    {
        if (!Auth::user()->can(['passo a passo.visualizar','passo a passo.remover'])) {
            return view('Admin.error.403');
        }
        $stepToStep->delete();
        Session::flash('success', 'Passo a passo deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['passo a passo.visualizar','passo a passo.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = StepToStep::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            StepToStep::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
