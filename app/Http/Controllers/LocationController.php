<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('localizacao.visualizar')){
            return view('Admin.error.403');
        }
        $location = Location::first();
        return view('Admin.cruds.location.index', [
            'location' => $location
        ]);
    }
    public function create()
    {
        if(!Auth::user()->can(['localizacao.visualizar','localizacao.criar'])){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.location.create');
    }
    public function store(LocationStoreRequest $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try{
            DB::beginTransaction();
            $location = Location::create($data);
            DB::commit();
            Session::flash('success', 'Localização criada com sucesso!');
            return redirect()->route('admin.dashboard.location.edit', [
                'location' => $location
            ]);
        }catch(\Exception $exception){
            DB::rollback();
            Session::flash('error', 'Erro ao criar Localização!');
            return redirect()->back();
        }
    }
    public function edit(Location $location)
    {
        $objectives = Objective::sorting()->get();
        return view('Admin.cruds.location.edit', [
            'location' => $location,
            'objectives' => $objectives
        ]);
    }
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try{
            DB::beginTransaction();
            $location->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Localização atualizada com sucesso!');
            return redirect()->route('admin.dashboard.location.edit', [
                'location' => $location
            ]);
        }catch(\Exception $exception){
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar Localização!');
            return redirect()->back();
        }
    }
    public function destroy(Location $location)
    {
        $location->delete();
        Session::flash('success', 'Localização excluída com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['localizacao.visualizar','localizacao.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Location::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Location::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
