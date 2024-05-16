<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Holiday;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('evento.visualizar')) {
            return view('Admin.error.403');
        }
        $events = Event::sorting()->paginate(30);
        $holidays = Holiday::sorting()->get();
        return view('Admin.cruds.event.index', [
            'events' => $events,
            'holidays' => $holidays
        ]);
    }

    public function create()
    {
        if (!Auth::user()->can(['evento.visualizar','evento.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.event.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        
        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;
                $data['slug'] = Str::slug($request->title,'-','pt-BR');
                Event::create($data);
            DB::commit();
            Session::flash('success', 'Evento cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.event.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar evento!');
            return redirect()->back();
            
        }
    }

    public function edit(Event $event)
    {
        if (!Auth::user()->can(['evento.visualizar','evento.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.event.edit', [
            'event' => $event
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->all();
        
        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;
                $data['slug'] = Str::slug($request->title,'-','pt-BR');
                $event->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Evento atualizado com sucesso!');
            return redirect()->route('admin.dashboard.event.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar evento!');
            return redirect()->back();
            
        }
    }

    public function destroy(Event $event)
    {
        if (!Auth::user()->can(['evento.visualizar','evento.remove'])) {
            return view('Admin.error.403');
        }
        $event->delete();
        Session::flash('success', 'Evento deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['evento.visualizar','evento.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Event::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Event::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
