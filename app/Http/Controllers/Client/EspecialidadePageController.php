<?php

namespace App\Http\Controllers\Client;

use App\Repositories\EspecialidadeRepository;
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

        $categorias = (new EspecialidadeRepository())->getEspecialidadeCategories();
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
        $categorias = (new EspecialidadeCategory())->getEspecialidadeCategories();
        $especialistas = EspecialidadeProfessional::sorting()->active();

        return view('Client.pages.especialidades',[
            
        ]);
    }
}
