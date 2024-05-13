<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MuralDeComunicacaoFeed;
use Illuminate\Support\Facades\Request;

class MuralDeComunicacaoInternaPageController extends Controller
{
    public function index(Request $request){
        $muralDeComunicacao = MuralDeComunicacaoFeed::with('category')
        ->where('mural_category_id', $request->category)
        ->where('slug', $request->slug)->sorting()->active();
        return view('Client.pages.mural-de-comunicacao-interna', [
            'muralDeComunicacao' => $muralDeComunicacao
        ]);
    }
}
