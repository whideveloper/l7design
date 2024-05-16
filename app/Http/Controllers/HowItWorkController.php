<?php

namespace App\Http\Controllers;

use App\Models\HowItWork;
use App\Models\StepToStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\HowItWorkStoreRequest;
use App\Http\Requests\HowItWorkUpdateRequest;

class HowItWorkController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('como funciona.visualizar')) {
            return view('Admin.error.403');
        }
        $howItWork = HowItWork::first();
        return view('Admin.cruds.howItWork.index', [
            'howItWork' => $howItWork
        ]);
    }
    public function create()
    {
        if (!Auth::user()->can(['como funciona.visualizar','como funciona.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.howItWork.create');
    }
    public function store(HowItWorkStoreRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['active'] = $request->active ? 1 : 0;
            $howItWork = HowItWork::create($data);
            DB::commit();
            Session::flash('success', 'Registro criado com sucesso!');
            return redirect()->route('admin.dashboard.howItWork.edit', [
                'howItWork' => $howItWork
            ]);
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollback();
            Session::flash('error', 'Erro ao criar Registro!');
            return redirect()->back();
        }
    }
    public function edit(HowItWork $howItWork)
    {
        if (!Auth::user()->can(['como funciona.visualizar','como funciona.editar'])) {
            return view('Admin.error.403');
        }
        $stepToSteps = StepToStep::sorting()->get();

        return view('Admin.cruds.howItWork.edit', [
            'howItWork' => $howItWork,
            'stepToSteps' => $stepToSteps,
        ]);
    }
    public function update(HowItWorkUpdateRequest $request, HowItWork $howItWork)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['active'] = $request->active ? 1 : 0;
            $howItWork->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Registro atualizado com sucesso!');
            return redirect()->route('admin.dashboard.howItWork.edit', [
                'howItWork' => $howItWork
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar Registro!');
            return redirect()->back();
        }
    }
    public function destroy(HowItWork $howItWork)
    {
        if (!Auth::user()->can(['como funciona.visualizar','como funciona.remove'])) {
            return view('Admin.error.403');
        }
        $howItWork->delete();
        Session::flash('success', 'Registro deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['como funciona.visualizar','como funciona.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = HowItWork::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }
}
