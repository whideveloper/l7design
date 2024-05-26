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
        $especialistas = EspecialidadeProfessional::sorting()->active();
        if ($category) {
            $especialistas->join('especialidade_categories', 'especialidade_professionals.especialidade_category_id', 'especialidade_categories.id')
            ->select([
                'especialidade_categories.id as category_id', 
                'especialidade_categories.title',
                'especialidade_categories.slug',
                'especialidade_categories.active',
                'especialidade_professionals.id',
                'especialidade_professionals.name',
                'especialidade_professionals.especialidade_category_id',
                'especialidade_professionals.crm',
                'especialidade_professionals.description',
                'especialidade_professionals.text',
                'especialidade_professionals.active as profissional_active',
                'especialidade_professionals.path_image',
                ])
            ->where('especialidade_categories.slug', $category);
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
