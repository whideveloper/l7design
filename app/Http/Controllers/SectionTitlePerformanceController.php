<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SectionTitlePerformance;
use Illuminate\Support\Facades\Session;

class SectionTitlePerformanceController extends Controller
{

    public function index()
    {
        $sectionTitlePerformance = SectionTitlePerformance::first();
        
        return view('admin.cruds.performance.index', compact('sectionTitlePerformance'));
    }

    public function create()
    {
        return view('admin.cruds.performance.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                SectionTitlePerformance::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.sectionTitlePerformance.index');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Erro ao cadastrar item!');
        }
    }

    public function edit(SectionTitlePerformance $sectionTitlePerformance)
    {
        return view('admin.cruds.performance.edit', compact('sectionTitlePerformance'));
    }

    public function update(Request $request, SectionTitlePerformance $sectionTitlePerformance)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $sectionTitlePerformance->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com sucesso!');
            return redirect()->route('admin.dashboard.sectionTitlePerformance.edit', $sectionTitlePerformance->id);
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(SectionTitlePerformance $sectionTitlePerformance)
    {
        $sectionTitlePerformance->delete();
        Session::flash('success', 'Item deletado com sucesso!');
        return redirect()->back();
    }
}
