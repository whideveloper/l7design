<?php

namespace App\Http\Controllers;

use App\Models\Depoiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class DepoimentController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('depoimento.visualizar')) {
            return view('Admin.error.403');
        }
        $depoiments = Depoiment::sorting()->get();
        return view('Admin.cruds.depoiment.index', [
            'depoiments' => $depoiments
        ]);
    }
    public function create()
    {
        if (!Auth::user()->can(['depoimento.visualizar','depoimento.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.depoiment.create');
    }
    public function store(Request $request)
    {
        $data =$request->all();

        try {
            DB::beginTransaction();
            $data['active'] = $request->active ? 1 : 0;
            Depoiment::create($data);
            DB::commit();
            Session::flash('success', 'Depoimento criado com sucesso!');
            return redirect()->route('admin.dashboard.depoiment.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', "Erro ao criar Depoimento!");
            return redirect()->back();
        }
    }
    public function edit(Depoiment $depoiment)
    {
        if (!Auth::user()->can(['depoimento.visualizar','depoimento.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.depoiment.edit', [
            'depoiment' => $depoiment
        ]);
    }

    public function update(Request $request, Depoiment $depoiment)
    {   
        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['active'] = $request->active ? 1 : 0;
            $depoiment->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Depoimento atualizado com sucesso!');
            return redirect()->route('admin.dashboard.depoiment.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', "Erro ao criar Depoimento!");
            return redirect()->back();
        }
    }

    public function destroy(Depoiment $depoiment)
    {
        $depoiment->delete();
        Session::flash('success', 'Depoimento deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['depoimento.visualizar','depoimento.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Depoiment::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Depoiment::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
