<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\EspecialidadeCategory;
use App\Models\EspecialidadeProfessional;
use App\Models\EspecialidadeSession;
use App\Models\Training;
use App\Models\TrainingForUse;
use App\Models\Tutorial;

class EspecialidadePageController extends Controller
{
    public function index(){

        $categorias = EspecialidadeCategory::join('especialidade_professionals', 'especialidade_categories.id', 'especialidade_professionals.especialidade_category_id')
        ->sorting()->active()
        ->select([
            'especialidade_categories.id', 
            'especialidade_categories.title',
            'especialidade_categories.slug',
            'especialidade_categories.active',
            ])
        ->orderBy('especialidade_categories.id',)
        ->orderBy('especialidade_categories.title')
        ->orderBy('especialidade_categories.slug')
        ->orderBy('especialidade_categories.active')
        ->groupBy('especialidade_categories.id',)
        ->groupBy('especialidade_categories.title')
        ->groupBy('especialidade_categories.slug')
        ->groupBy('especialidade_categories.active')
        ->get();
        $sessaoEspecialidade = EspecialidadeSession::active()->first();
        $especialistas = EspecialidadeProfessional::sorting()->active()->get();
        $tutorial = Tutorial::active()->first();
        $trainingForUse = TrainingForUse::active()->first();
        $arquivoTreinamentos = Training::active()->get();
        $agendamento = Agendamento::active()->first();
        
        return view('Client.pages.especialidades', [
            'categorias' => $categorias,
            'sessaoEspecialidade' => $sessaoEspecialidade,
            'especialistas' => $especialistas,  
            'tutorial' => $tutorial,
            'trainingForUse' => $trainingForUse,
            'arquivoTreinamentos' => $arquivoTreinamentos,
            'agendamento' => $agendamento
        ]);
    }
    
    public function filter(){

    }
}
