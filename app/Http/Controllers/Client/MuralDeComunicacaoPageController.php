<?php

namespace App\Http\Controllers\Client;


use App\Models\MuralDeApoio;
use App\Http\Controllers\Controller;
use App\Models\MuralDeComunicacaoFeed;
use App\Repositories\MuralDeComunicacao;

class MuralDeComunicacaoPageController extends Controller
{
    public function index($category = null){
        $categorias = (new MuralDeComunicacao())->getMuralDeComunicacaoCategories();
        $muralDeComunicacoes = MuralDeComunicacaoFeed::sorting()->active();
        $sessaoMuralDeComunicacao = MuralDeApoio::active()->first();
        
        if ($category) {
            $muralDeComunicacoes->join('mural_de_comunicacao_categories', 'mural_de_comunicacao_feeds.mural_category_id', 'mural_de_comunicacao_categories.id')
            ->where('mural_de_comunicacao_categories.slug', $category);
        }

        $muralDeComunicacoes = $muralDeComunicacoes->paginate(3);

        return view('Client.pages.mural-de-comunicacao', [
            'categorias' => $categorias,
            'muralDeComunicacoes' => $muralDeComunicacoes,
            'sessaoMuralDeComunicacao' => $sessaoMuralDeComunicacao,
        ]);
    }
}
