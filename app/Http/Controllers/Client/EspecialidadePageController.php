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
use HTMLPurifier;
use HTMLPurifier_Config;

class EspecialidadePageController extends Controller
{
    public function index($category = null)
    {
        $categorias = (new EspecialidadeRepository())->getEspecialidadeCategories();
        $especialistas = (new EspecialidadeRepository())->getEspecialistas()->sorting()->active();

        if ($category) {
            $especialistas = (new EspecialidadeRepository())->getEspecialistas()
            ->where('especialidade_categories.slug', $category)->sorting()->active();
        }
        $especialistas = $especialistas->paginate(9);
        $sessaoEspecialidade = EspecialidadeSession::active()->first();       
        $tutorial = Tutorial::active()->first();
        $trainingForUse = TrainingForUse::active()->first();
        $arquivoTreinamentos = Training::sorting()->active()->get();
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
