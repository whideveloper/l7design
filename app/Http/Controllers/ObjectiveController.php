<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Location;

class ObjectiveController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/objetivo/';

    public function create()
    {
        if (!Auth::user()->can(['objetivo.visualizar','objetivo.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.objective.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            if (!Objective::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }
            $location = Location::first();
            DB::commit();
            Session::flash('success', 'Objetivo criado com sucesso!');
            return redirect()->route('admin.dashboard.location.edit', ['location' => $location->id]);
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollback();
            Session::flash('error', 'Erro ao criar Objetivo!');
            return redirect()->back();
        }
    }

    public function edit(Objective $objective)
    {
        if (!Auth::user()->can(['objetivo.visualizar','objetivo.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.objective.edit', [
            'objective'=>$objective
        ]);
    }

    public function update(Request $request, Objective $objective)
    {
        $data = $request->all();
        $helper = new HelperArchive();
        $data['active'] = $request->active?1:0;

        try{
            DB::beginTransaction();
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                Storage::delete($objective->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($objective->$inputFile);
                $data['path_image'] = null;
            }
            $objective->fill($data)->save();
            $location = Location::first();
            
            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            DB::commit();
            Session::flash('success', 'Objetivo atualizado com sucesso!');
            return redirect()->route('admin.dashboard.location.edit', ['location' => $location->id]);
        }catch(\Exception $exception){
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar Objetivo!');
            return redirect()->back();
        }
    }
    public function destroy(Objective $objective)
    {
        if (!Auth::user()->can(['objetivo.visualizar','objetivo.remove'])) {
            return view('Admin.error.403');
        }
        Storage::delete($objective->path_image);
        $objective->delete();
        Session::flash('success', 'Objetivo deletado com sucesso!');
        return redirect()->back();
    }
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Objective::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
