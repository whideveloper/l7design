<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingForUse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class TrainingController extends Controller
{
    protected $pathUpload = 'admin/uploads/files/treinamento/';
    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {
                $data['path_file'] = $this->pathUpload . $path_file;
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }
            $data['active'] = $request->active ? 1 : 0;

            
            if (!Training::create($data)) {
                Storage::delete($this->pathUpload . $path_file);
                throw new Exception();
            }
            $trainingForUse = TrainingForUse::first();

            Session::flash('success', 'Informação cadastrada com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.trainingForUse.edit', [
                'trainingForUse' => $trainingForUse
            ]);
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Informação!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Training $training)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {
                $data['path_file'] = $this->pathUpload . $path_file;
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
                Storage::delete($training->path_file);
            }
            if(isset($request->delete_path_file) && !$path_file){
                $inputFile = $request->delete_path_file;
                Storage::delete($training->$inputFile);
                $data['path_file'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $training->fill($data)->save();

            if ($path_file) {
                Storage::delete($this->pathUpload . $path_file);
            }
            if ($path_file) {
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }
            $trainingForUse = TrainingForUse::first();
            DB::commit();
            Session::flash('success', 'Informação atualizada com sucesso!');
            return redirect()->route('admin.dashboard.trainingForUse.edit', [
                'trainingForUse' => $trainingForUse
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar Informação!');
            return redirect()->back();
        }
    }


    public function destroy(Training $training)
    {
        if(!Auth::user()->can(['treinamento.visualizar', 'treinamento.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($training->path_file);
        $training->delete();

        Session::flash('success','Informação deletada com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['treinamento.visualizar','treinamento.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Training::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Training::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
