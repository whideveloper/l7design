<?php

namespace App\Http\Controllers\Client;

use App\Models\Material;
use App\Models\Protocol;
use App\Http\Controllers\Controller;

class MaterialDeApoioPageController extends Controller
{
    public function index(){
        $protocolo = Protocol::active()->first();
        $materialSections = Material::with(['document' => function ($query) {
            $query->active()->orderBy('sorting', 'ASC');
        }])
        ->active()
        ->orderBy('sorting', 'ASC')
        ->get();

        return view('Client.pages.material-de-apoio', [
            'protocolo' => $protocolo,
            'materialSections' => $materialSections
        ]);
    }
}
