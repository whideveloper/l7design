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
use Illuminate\Http\Request;

class EspecialidadePageController extends Controller
{
    public function index(){

        $categorias = EspecialidadeCategory::join('especialidade_professionals', 'especialidade_categories.id', 'especialidade_professionals.especialidade_category_id')
        ->sorting()->active()->get();
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
}
