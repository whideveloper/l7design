<?php
namespace App\Repositories;

use App\Models\EspecialidadeCategory;
use App\Models\EspecialidadeProfessional;

class EspecialidadeRepository
{
    public function getEspecialidadeCategories()
    {
        return EspecialidadeCategory::join('especialidade_professionals', 'especialidade_categories.id', 'especialidade_professionals.especialidade_category_id')
        ->select([
            'especialidade_categories.id', 
            'especialidade_categories.title',
            'especialidade_categories.slug',
            'especialidade_categories.active',
            'especialidade_professionals.active'
            ])
        ->where('especialidade_categories.active', '=', 1)
        ->where('especialidade_professionals.active', '=', 1)
        ->orderBy('especialidade_categories.id',)
        ->orderBy('especialidade_categories.title')
        ->orderBy('especialidade_categories.slug')
        ->orderBy('especialidade_categories.active')
        ->groupBy('especialidade_categories.id')
        ->groupBy('especialidade_categories.title')
        ->groupBy('especialidade_categories.active')
        ->groupBy('especialidade_categories.slug')
        ->groupBy('especialidade_professionals.active')
        ->sorting()->active()
        ->get();
    }
    public function getEspecialistas(){
        return EspecialidadeProfessional::join('especialidade_categories', 'especialidade_professionals.especialidade_category_id', 'especialidade_categories.id')
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
        ]);
    }
}