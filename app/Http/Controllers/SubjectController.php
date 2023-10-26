<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/subject/';
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $subjects = Subject::with('userId');
        if(!Auth::user()->can('disciplina.visualizar')){
            return view('Admin.error.403');
        }
        if (Auth::user()->hasRole('Super') || Auth::user()->can('disciplina.visualizar outras disciplinas')){
            $subjects = $subjects->sorting();
        }else{
            $subjects = $subjects->where('user_id', $user)->sorting();
        }
        $subjects = $subjects->paginate(15);
//        dd($subjects);
        return view('Admin.cruds.subject.index', [
            'subjects'=>$subjects,
            'user'=>$user
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['disciplina.visualizar','disciplina.criar'])){
            return view('Admin.error.403');
        }
        $user = Auth::user()->id;

        return view('Admin.cruds.subject.create',[
            'user'=>$user
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {$data['path_image'] = $this->pathUpload . $path_image;}
            $data['active'] = $request->active ? 1 : 0;
            Subject::create($data);

            if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
            Session::flash('success', 'Matéria cadastrada com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.subject.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar a matéria!');
            return redirect()->back();
        }
    }

    public function show(Subject $subject)
    {
        //
    }


    public function edit(Subject $subject)
    {
        if (!Auth::user()->can(['disciplina.visualizar','disciplina.editar'])) {
            return view('Admin.error.403');
        }
        $user = Auth::user()->id;
        return view('Admin.cruds.subject.edit', [
            'subject'=>$subject,
            'user'=>$user
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) $data['path_image'] = $this->pathUpload . $path_image;
            if ($path_image) {
                Storage::delete($subject->path_image);
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($subject->$inputFile);
                $data['path_image'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;
            $data['user_id'] = $request->user_id;
            $subject->fill($data)->save();

            if ($path_image) {Storage::delete($this->pathUpload.$path_image);}
            if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
            DB::commit();
            Session::flash('success', 'Matéria atualizada com sucesso!');
            return redirect()->route('admin.dashboard.subject.index');
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar a matéria!');
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message-error'=>$exception->getMessage()]);
        }
    }

    public function destroy(Subject $subject)
    {
        if(!Auth::user()->can(['subject.visualizar','subject.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($subject->path_image);
        $subject->delete();

        Session::flash('success','Matéria deletada com sucesso!');
        return redirect()->back();
    }
}
