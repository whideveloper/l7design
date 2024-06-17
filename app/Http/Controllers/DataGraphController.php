<?php

namespace App\Http\Controllers;

use App\Models\DataGraph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DataGraphController extends Controller
{
    
    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                DataGraph::create($data);
            DB::commit();
            Session::flash('success', 'Importação realizada com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Não foi possível Importar o arquivo!');
            return redirect()->back();
        }
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
