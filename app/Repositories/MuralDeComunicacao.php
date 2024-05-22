<?php
namespace App\Repositories;

use App\Models\MuralDeComunicacaoFeed;
use App\Models\MuralDeComunicacaoCategory;

class MuralDeComunicacao
{
    public function getMuralDeComunicacaoCategories()
    {
        return MuralDeComunicacaoCategory::join('mural_de_comunicacao_feeds', 'mural_de_comunicacao_categories.id', 'mural_de_comunicacao_feeds.mural_category_id')
        ->select([
            'mural_de_comunicacao_categories.id', 
            'mural_de_comunicacao_categories.title',
            'mural_de_comunicacao_categories.slug',
            'mural_de_comunicacao_categories.active',
            'mural_de_comunicacao_feeds.active as feed_active',
            ])
        ->where('mural_de_comunicacao_categories.active', 1)
        ->where('mural_de_comunicacao_feeds.active', 1)
        ->orderBy('mural_de_comunicacao_feeds.active',)
        ->orderBy('mural_de_comunicacao_categories.id',)
        ->orderBy('mural_de_comunicacao_categories.title')
        ->orderBy('mural_de_comunicacao_categories.slug')
        ->orderBy('mural_de_comunicacao_categories.active')
        ->groupBy('mural_de_comunicacao_feeds.active',)
        ->groupBy('mural_de_comunicacao_categories.id',)
        ->groupBy('mural_de_comunicacao_categories.title')
        ->groupBy('mural_de_comunicacao_categories.slug')
        ->groupBy('mural_de_comunicacao_categories.active')
        ->sorting()->active()
        ->get();
    }

    public function getMuralDeComunicacao(){
        return MuralDeComunicacaoFeed::join('mural_de_comunicacao_categories', 'mural_de_comunicacao_feeds.mural_category_id', 'mural_de_comunicacao_categories.id')
        ->select([
        'mural_de_comunicacao_categories.id', 
        'mural_de_comunicacao_categories.title',
        'mural_de_comunicacao_categories.slug as category_slug',
        'mural_de_comunicacao_categories.active',
        'mural_de_comunicacao_feeds.mural_category_id',
        'mural_de_comunicacao_feeds.id as mural_id',
        'mural_de_comunicacao_feeds.title',
        'mural_de_comunicacao_feeds.path_image',
        'mural_de_comunicacao_feeds.slug as mural_slug',
        'mural_de_comunicacao_feeds.description',
        'mural_de_comunicacao_feeds.text',
        'mural_de_comunicacao_feeds.link',
        'mural_de_comunicacao_feeds.publish_date',
        'mural_de_comunicacao_feeds.btn_title',
        ]);
    }
}