<?php

namespace App\Http\Controllers\Client;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesempenhoPageController extends Controller
{
    public function index(){
        $maps = Map::sorting()->active()->get();
        // dd($maps);
        return view('Client.pages.desempenho',[
            'maps' => $maps
        ]);
    }
}
