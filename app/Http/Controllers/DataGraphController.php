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

        try {
            // Verifica se há dados na tabela
            if (DB::table('data_graphs')->exists()) {
                // Remove os dados existentes
                DB::table('data_graphs')->truncate();
            }

            // Importa o novo arquivo
            Excel::import(new DataGraphImport, $request->file('file'));

            return back()->with('success', 'Importação realizada com sucesso!');
        } catch (\Exception $e) {

            return back()->with('error', 'Ocorreu um erro durante a importação: ' . $e->getMessage());
        }
    }
}
