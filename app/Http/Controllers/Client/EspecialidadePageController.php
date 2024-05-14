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
    public function index($category = null)
    {
        $categorias = (new EspecialidadeRepository())->getEspecialidadeCategories();
        $especialistas = EspecialidadeProfessional::sorting()->active();
        
        if ($category) {
            $especialistas->join('especialidade_categories', 'especialidade_professionals.especialidade_category_id', 'especialidade_categories.id')
            ->where('especialidade_categories.slug', $category);
        }
        
        $especialistas = $especialistas->paginate(3);
        $sessaoEspecialidade = EspecialidadeSession::active()->first();       
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
