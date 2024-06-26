<?php

namespace App\Http\Controllers;

use App\Models\MuralDeApoio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MuralDeComunicacaoFeed;
use Illuminate\Support\Facades\Session;
use App\Models\MuralDeComunicacaoCategory;

class MuralDeApoioController extends Controller
{

    public function index()
    {
        if(!Auth::user()->can('mural de comunicacao.visualizar')){
            return view('Admin.error.403');
        }
        $muralDeApoio = MuralDeApoio::first();

        return view('Admin.cruds.muralDeApoio.index', [
            'muralDeApoio' => $muralDeApoio
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.criar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.muralDeApoio.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                $muralDeApoio = MuralDeApoio::create($data);
            DB::commit();
            Session::flash('success', 'Informção cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.muralDeApoio.edit', [
                'muralDeApoio' => $muralDeApoio
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar Informção!');
            return redirect()->back();
        }
    }

    public function edit(MuralDeApoio $muralDeApoio)
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.editar'])){
            return view('Admin.error.403');
        }
        $categoryTitle = [];
        $categoryEspecialidade = MuralDeComunicacaoCategory::active()->get();
        foreach($categoryEspecialidade as $title){
            $categoryTitle[$title->id] = $title->title;
        }
        $muralDeComunicacaoFeeds = MuralDeComunicacaoFeed::join('mural_de_comunicacao_categories', 'mural_de_comunicacao_feeds.mural_category_id', 'mural_de_comunicacao_categories.id')
        ->select(
            'mural_de_comunicacao_categories.id as category_id', 
            'mural_de_comunicacao_categories.title as categoria',
            'mural_de_comunicacao_feeds.title',
            'mural_de_comunicacao_feeds.path_image',
            'mural_de_comunicacao_feeds.sorting',
            'mural_de_comunicacao_feeds.active',
            'mural_de_comunicacao_feeds.text',
            'mural_de_comunicacao_feeds.id as mural_de_comunicacao_id',
            )->sorting()->get();
        return view('Admin.cruds.muralDeApoio.edit', [
            'muralDeApoio' => $muralDeApoio,
            'muralDeComunicacaoFeeds' => $muralDeComunicacaoFeeds
        ]);
    }

    public function update(Request $request, MuralDeApoio $muralDeApoio)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                $muralDeApoio->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Informção atualizada com sucesso!');
            return redirect()->route('admin.dashboard.muralDeApoio.edit', [
                'muralDeApoio' => $muralDeApoio
            ]);
        } catch (\Exception $exception) {            
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar Informção!');
            return redirect()->back();
        }
    }

    public function destroy(MuralDeApoio $muralDeApoio)
    {
        if(!Auth::user()->can(['mural de comunicacao.visualizar','mural de comunicacao.remover'])){
            return view('Admin.error.403');
        }

        $muralDeApoio->delete();

        Session::flash('success','Informação deletada com sucesso!');
        return redirect()->back();
    }
}
