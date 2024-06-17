<?php

namespace App\Http\Controllers\Client;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataGraph;

class DesempenhoPageController extends Controller
{
    public function index(){
        $maps = Map::sorting()->active()->get();
        $dataGraphs = DataGraph::get();

        // dd($dataGraphs);
        return view('Client.pages.desempenho',[
            'maps' => $maps,
            'dataGraphs' => $dataGraphs
        ]);
    }
}
