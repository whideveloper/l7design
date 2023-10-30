<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Course;
use App\Models\File;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    protected $pathUpload = 'admin/uploads/file/';
    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {$data['path_file'] = $this->pathUpload . $path_file;}

            $data['active'] = $request->active ? 1 : 0;
//            dd($data);
            File::create($data);
            if ($path_file) {$request->file('path_file')->storeAs($this->pathUpload, $path_file);}
            Session::flash('success', 'Atividade cadastrada com sucesso!');

            DB::commit();
            return redirect()->back();
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar a atividade!');
            return redirect()->back();
        }
    }

    public function edit(File $file){
        $user = Auth::user()->id;
        $course = Course::where('id', $file->course->id)->first();
        $subjects = Subject::active()->where('user_id', $user)->get();
        return view('Admin.cruds.file.edit', [
            'file'=>$file,
            'course'=>$course,
            'user'=>$user,
            'subjects'=>$subjects
        ]);
    }
    public function update(Request $request, File $file)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) $data['path_file'] = $this->pathUpload . $path_file;

            if ($path_file && isset($file->path_file)) {
                Storage::delete($file->path_file);
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }

            if (isset($request->delete_path_file) && !$path_file) {
                $inputFile = $request->delete_path_file;
                Storage::delete($file->$inputFile);
                $data['path_file'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            if ($path_file) {
                Storage::delete($this->pathUpload . $path_file);
                $request->file('path_file')->storeAs($this->pathUpload, $path_file);
            }
//            dd($data);
            $file->update($data);


            DB::commit();
            Session::flash('success', 'Atividade atualizada com sucesso!');
            return redirect()->route('admin.dashboard.course.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar a atividade!');
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message-error' => $exception->getMessage()]);
        }

    }

    public function destroy(File $file)
    {
        Storage::delete($file->path_file);

        $file->delete();
        Session::flash('success','Atividade deletada com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if(!Auth::user()->can(['atividade.visualizar','atividade.remover'])){
            return view('Admin.error.403');
        }

        if($deleted = File::whereIn('id', $request->deleteAll)->delete()){

            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            File::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
