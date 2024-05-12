<?php
namespace App\Repositories;

use App\Models\EspecialidadeCategory;
use App\Models\EspecialidadeProfessional;

class EspecialidadeRepository
{
    public function getEspecialidadeCategories()
    {
        return EspecialidadeCategory::join('especialidade_professionals', 'especialidade_categories.id', 'especialidade_professionals.especialidade_category_id')
        ->sorting()->active()
        ->select([
            'especialidade_categories.id', 
            'especialidade_categories.title',
            'especialidade_categories.slug',
            'especialidade_categories.active',
            ])
        ->orderBy('especialidade_categories.id')
        ->orderBy('especialidade_categories.title')
        ->orderBy('especialidade_categories.slug')
        ->orderBy('especialidade_categories.active')
        ->get();
    }
}