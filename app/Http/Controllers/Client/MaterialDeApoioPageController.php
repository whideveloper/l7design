<?php

namespace App\Http\Controllers\Client;

use App\Models\Material;
use App\Models\Protocol;
use App\Http\Controllers\Controller;

class MaterialDeApoioPageController extends Controller
{
    public function index(){
        $protocolo = Protocol::active()->first();
        $materialSections = Material::active()->get();
        return view('Client.pages.material-de-apoio', [
            'protocolo' => $protocolo,
            'materialSections' => $materialSections
        ]);
    }
}