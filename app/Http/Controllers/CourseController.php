<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/course/';
    protected $pathUploadVideo = 'admin/uploads/video/course/';
    public function index()
    {
        if(!Auth::user()->can('curso.visualizar')){
            return view('Admin.error.403');
        }
        $user = Auth::user()->id;
        $subjects = Subject::active()->where('user_id', $user)->get();
        $courses = Course::sorting()->paginate(15);
        return view('Admin.cruds.course.index', [
            'courses'=>$courses,
            'subjects'=>$subjects,
            'user'=>$user
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['curso.visualizar','curso.criar'])){
            return view('Admin.error.403');
        }
        $user = Auth::user()->id;
        $select = [];
        $subjects = Subject::active()->where('user_id', $user)->get();
        foreach ($subjects as $subject) {
            $select[$subject->id] = $subject->name;
        }

        return view('Admin.cruds.course.create', [
            'subjects' => $select,
            'subject' => $request->subject??null,
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

            $video = $helper->renameArchiveUpload($request, 'video');
            if ($video) {$data['video'] = $this->pathUploadVideo . $video;}

            $data['active'] = $request->active ? 1 : 0;
            $data['slug'] = Str::slug($request->title);

            $course = Course::create($data);
            if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
            if ($video) {$request->file('video')->storeAs($this->pathUploadVideo, $video);}
            DB::commit();
            return redirect()
                ->route('admin.dashboard.course.edit', ['course' => $course])
                ->with(Session::flash('success', 'Curso cadastrado com sucesso!'));
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o curso!');
            return redirect()->back();
        }
    }

    public function edit(Course $course)
    {
        if(!Auth::user()->can(['curso.visualizar','curso.editar'])){
            return view('Admin.error.403');
        }
        $user = Auth::user()->id;
        $select = [];
        $subjects = Subject::active()->where('user_id', $user)->get();
        foreach ($subjects as $subject) {
            $select[$subject->id] = $subject->name;
        }
        $user = Auth::user()->id;
        $course = Course::with(['file' => function ($query)
        {$query->orderBy('sorting', 'ASC');}])
            ->where('id', $course->id)
            ->first();
        return view('Admin.cruds.course.edit', [
            'course'=>$course,
            'subjects' => $select,
            'user'=>$user
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) $data['path_image'] = $this->pathUpload . $path_image;
            if ($path_image) {
                Storage::delete($course->path_image);
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($course->$inputFile);
                $data['path_image'] = null;
            }

            $video = $helper->renameArchiveUpload($request, 'video');
            if ($video) $data['video'] = $this->pathUploadVideo . $video;
            if ($video) {
                Storage::delete($course->video);
                $request->file('video')->storeAs($this->pathUploadVideo, $video);
            }
            if(isset($request->delete_video) && !$video){
                $inputFile = $request->delete_video;
                Storage::delete($course->$inputFile);
                $data['video'] = null;
            }

            $data['active'] = $request->active ? 1 : 0;

            $course->fill($data)->save();

            if ($path_image) {Storage::delete($this->pathUpload.$path_image);}
            if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}

            if ($video) {Storage::delete($this->pathUploadVideo.$video);}
            if ($video) {$request->file('video')->storeAs($this->pathUploadVideo, $video);}

            DB::commit();
            return redirect()
                ->route('admin.dashboard.course.edit', ['course' => $course])
                ->with(Session::flash('success', 'Curso atualizado com sucesso!'));
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o curso!');
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message-error'=>$exception->getMessage()]);
        }
    }

    public function destroy(Course $course)
    {
        if(!Auth::user()->can(['curso.visualizar','curso.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($course->path_image);
        Storage::delete($course->video);

        $course->delete();
        Session::flash('success','Curso deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if(!Auth::user()->can(['curso.visualizar','curso.remover'])){
            return view('Admin.error.403');
        }

        if(!Auth::user()->can(['curso.visualizar','curso.remover'])){
            return view('Admin.error.403');
        }

        if($deleted = Course::whereIn('id', $request->deleteAll)->delete()){

            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        if(!Auth::user()->can(['curso.visualizar','curso.editar'])){
            return view('Admin.error.403');
        }
        if(!Auth::user()->can('curso.visualizar')){
            return view('Admin.error.403');
        }

        foreach($request->arrId as $sorting => $id){
            Course::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}