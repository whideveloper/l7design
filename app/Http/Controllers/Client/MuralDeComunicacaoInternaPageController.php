<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MuralDeComunicacaoFeed;
use Illuminate\Support\Facades\Request;
use App\Repositories\MuralDeComunicacao;

class MuralDeComunicacaoInternaPageController extends Controller
{
    public function index($slug = null, $title = null){


        if ($slug && $title) {
            $muralDeComunicacao = (new MuralDeComunicacao())->getMuralDeComunicacao()
            ->where('mural_de_comunicacao_categories.slug', $slug)
            ->where('mural_de_comunicacao_feeds.slug', $title)
            ->sorting()->active()->first();
            
            $muralDeComunicacaoRelacionados = (new MuralDeComunicacao())->getMuralDeComunicacao()
            ->where('mural_de_comunicacao_categories.slug', $slug)
            ->where('mural_de_comunicacao_feeds.id', '<>',  $muralDeComunicacao->mural_id)
            ->sorting()->active()->get();

            // dd($muralDeComunicacaoRelacionados);
        }
        
        return view('Client.pages.mural-de-comunicacao-interna', [
            'muralDeComunicacao' => $muralDeComunicacao,
            'muralDeComunicacaoRelacionados' => $muralDeComunicacaoRelacionados,
        ]);
    }

    public function relacionados(){
        $muralDeComunicacao = (new MuralDeComunicacao())->getMuralDeComunicacao()->sorting()->active()->first();

        $muralDeComunicacaoRelacionados = (new MuralDeComunicacao())->getMuralDeComunicacao()
        ->where('mural_de_comunicacao_feeds.mural_category_id', $muralDeComunicacao->category_id)
        ->sorting()->active()->get();

        return view('Client.pages.mural-de-comunicacao-interna', [
            'muralDeComunicacaoRelacionados' => $muralDeComunicacaoRelacionados,
            'muralDeComunicacao' => $muralDeComunicacao
        ]);
    }
}
