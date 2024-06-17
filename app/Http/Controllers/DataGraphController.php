<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataGraph;
use Illuminate\Http\Request;
use App\Imports\DataGraphImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DataGraphController extends Controller
{
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new DataGraphImport, request()->file('file'));

        return back()->with('success', 'Importação realizada com sucesso!');
    }

    public function update(Request $request, DataGraph $dataGraph)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $dataGraph->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Importação atualizada com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Não foi atualizar o arquivo!');
            return redirect()->back();
        }
    }

}
