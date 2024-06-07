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
        $muralDeComunicacoes = (new MuralDeComunicacao())->getMuralDeComunicacao()->sorting()->active();
        $sessaoMuralDeComunicacao = MuralDeApoio::active()->first();
        
        if ($category) {
            $muralDeComunicacoes = (new MuralDeComunicacao())->getMuralDeComunicacao()
            ->where('mural_de_comunicacao_feeds.active', 1)
            ->where('mural_de_comunicacao_categories.slug', $category);
        }
        $muralDeComunicacoes = $muralDeComunicacoes->paginate(9);

        return view('Client.pages.mural-de-comunicacao', [
            'categorias' => $categorias,
            'muralDeComunicacoes' => $muralDeComunicacoes,
            'sessaoMuralDeComunicacao' => $sessaoMuralDeComunicacao,
        ]);
    }
}
