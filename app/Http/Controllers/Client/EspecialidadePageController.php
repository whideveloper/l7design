<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\EspecialidadeCategory;
use App\Models\EspecialidadeProfessional;
use App\Models\EspecialidadeSession;
use Illuminate\Http\Request;

class EspecialidadePageController extends Controller
{
    public function index(){

        $categorias = EspecialidadeCategory::join('especialidade_professionals', 'especialidade_categories.id', 'especialidade_professionals.especialidade_category_id')
        ->sorting()->active()->get();
        $sessaoEspecialidade = EspecialidadeSession::active()->first();
        $especialistas = EspecialidadeProfessional::sorting()->active()->get();
        
        return view('Client.pages.especialidades', [
            'categorias' => $categorias,
            'sessaoEspecialidade' => $sessaoEspecialidade,
            'especialistas' => $especialistas
        ]);
    }
}
