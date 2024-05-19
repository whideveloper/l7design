<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class HolidayController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('evento.visualizar')) {
            return view('Admin.error.403');
        }
        $holidays = Holiday::sorting()->paginate(30);

        return view('Admin.cruds.holiday.index', [
            'holidays' => $holidays
        ]);
    }

    public function create()
    {
        if (!Auth::user()->can(['evento.visualizar','evento.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.holiday.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;
                $data['slug'] = Str::slug($request->title,'-','pt-BR');
                Holiday::create($data);
            DB::commit();
            Session::flash('success', 'Feriado cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.event.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar feriado!');
            return redirect()->back();
            
        }
    }

    public function edit(Holiday $holiday)
    {
        if (!Auth::user()->can(['evento.visualizar','evento.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.holiday.edit', [
            'holiday' => $holiday
        ]);
    }

    public function update(Request $request, Holiday $holiday)
    {
        $data = $request->all();
        
        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;
                $data['slug'] = Str::slug($request->title,'-','pt-BR');
                $holiday->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Feriado atualizado com sucesso!');
            return redirect()->route('admin.dashboard.event.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar evento!');
            return redirect()->back();
            
        }
    }

    public function destroy(Holiday $holiday)
    {
        if (!Auth::user()->can(['evento.visualizar','evento.remover'])) {
            return view('Admin.error.403');
        }
        $holiday->delete();
        Session::flash('success', 'Feriado deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['evento.visualizar','evento.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Holiday::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Holiday::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
