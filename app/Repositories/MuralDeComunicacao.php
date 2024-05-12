<?php
namespace App\Repositories;

use App\Models\MuralDeComunicacaoCategory;

class MuralDeComunicacao
{
    public function getMuralDeComunicacaoCategories()
    {
        return MuralDeComunicacaoCategory::join('mural_de_comunicacao_feeds', 'mural_de_comunicacao_categories.id', 'mural_de_comunicacao_feeds.mural_category_id')
        ->sorting()->active()
        ->select([
            'mural_de_comunicacao_categories.id', 
            'mural_de_comunicacao_categories.title',
            'mural_de_comunicacao_categories.slug',
            'mural_de_comunicacao_categories.active',
            ])
        ->orderBy('mural_de_comunicacao_categories.id',)
        ->orderBy('mural_de_comunicacao_categories.title')
        ->orderBy('mural_de_comunicacao_categories.slug')
        ->orderBy('mural_de_comunicacao_categories.active')
        ->get();
    }
}