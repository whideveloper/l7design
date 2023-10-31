<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentSubjects;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/student/';
    public function index()
    {
        if(!Auth::user()->can('aluno.visualizar')){
            return view('Admin.error.403');
        }
        $user = Auth::user()->id;
        $students = StudentSubjects::join('students', 'student_subjects.student_id', 'students.id')
            ->join('subjects', 'student_subjects.subject_id', 'subjects.id')
            ->select([
                'students.name',
                'students.email',
                'students.created_at',
                'students.active',
                'students.sorting',
                'students.id',
                'subjects.user_id'
            ])
            ->where('subjects.user_id', $user)
            ->groupBy([
                'students.name',
                'students.email',
                'students.created_at',
                'students.active',
                'students.sorting',
                'students.id',
                'subjects.user_id'
            ])
            ->paginate(15);

        $subjects = Subject::get();
        $studentsDeleted_at = Student::onlyTrashed()->count();
        return view('Admin.cruds.student.index',[
            'students'=>$students,
            'studentsDeleted_at'=>$studentsDeleted_at,
            'subjects'=>$subjects,
        ]);
    }
    public function create()
    {
        if (!Auth::user()->can(['aluno.visualizar','aluno.criar'])) {
            return view('Admin.error.403');
        }

        return view('Admin.cruds.student.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {$data['path_image'] = $this->pathUpload . $path_image;}
            $data['password'] = Hash::make($request->password);
            $data['active'] = $request->active ? 1 : 0;

            $studentExist = Student::where('email', $data['email'])->first();

            if ($studentExist) {
                Storage::delete($this->pathUpload . $path_image);

                return redirect()
                    ->back()
                    ->with('error', 'Erro ao cadastrar aluno! Este e-mail já existe em nossos registros.');
            } else {
                $student = Student::create($data);

                if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
                Session::flash('success', 'Aluno cadastrado com sucesso!');
            }

            DB::commit();
            return redirect()->route('admin.dashboard.student.index');
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Aluno!');
            return redirect()->back();
        }
    }

    public function deletedShow(Student $student){
        if(!Auth::user()->can(['usuario.restaurar dados','usuario.visualizar'])){
            return view('Admin.error.403');
        }
        $studentsDeleted_at = Student::onlyTrashed()->paginate(5);
        return view('Admin.cruds.student.show', [
            'studentsDeleted_at' => $studentsDeleted_at,
            'student' => $student
        ]);
    }

    public function edit(Student $student)
    {
        if (!Auth::user()->can(['aluno.visualizar','aluno.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.student.edit', [
            'student'=>$student
        ]);
    }
    public function search(Request $request){
        if(!Auth::user()->can('usuario.visualizar')){
            return view('Admin.error.403');
        }

        $studentsDeleted_at = Student::onlyTrashed();

        if ($request->filled('name')) {
            $studentsDeleted_at = Student::onlyTrashed()
                ->where('name', 'LIKE', '%' . $request->input('name') . '%');

        }
        if ($request->filled('email')) {
            $studentsDeleted_at = Student::onlyTrashed()
                ->where('email', 'LIKE', '%' . $request->input('email') . '%');

        }
        $studentsDeleted_at = $studentsDeleted_at->paginate(15);

        return view('Admin.cruds.student.show', [
            'studentsDeleted_at' => $studentsDeleted_at
        ]);
    }
    public function update(Request $request, Student $student)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) $data['path_image'] = $this->pathUpload . $path_image;
            if ($path_image) {
                Storage::delete($student->path_image);
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($student->$inputFile);
                $data['path_image'] = null;
            }

            $data['password'] = Hash::make($request->password);
            $data['active'] = $request->active ? 1 : 0;
            if($request->password == '') unset($data['password']);

            $student->fill($data)->save();

            if ($path_image) {Storage::delete($this->pathUpload.$path_image);}
            if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
            DB::commit();
            Session::flash('success', 'Aluno atualizado com sucesso!');
            return redirect()->route('admin.dashboard.student.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o Aluno!');
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message-error'=>$exception->getMessage()]);
        }
    }

    public function destroy(Student $student)
    {
        if(!Auth::user()->can(['aluno.visualizar','aluno.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($student->path_image);
        $student->delete();

        Session::flash('success','Aluno deletado com sucesso!');
        return redirect()->back();
    }

    public function deleteForced($id)
    {
        if (!Auth::user()->can(['usuario.visualizar','usuario.remover'])) {
            return view('Admin.error.403');
        }

        $student = Student::withTrashed()->find($id);
        if ($student) {
            // Verifique se o usuário autenticado tem permissão para excluir permanentemente o user (opcional)
            // ...

            try {
                $student->forceDelete();
                Session::flash('success', 'Aluno excluído com sucesso!');
                Session::flash('reopenModal','modal-user');
            } catch (\Exception $e) {
                Session::flash('error', 'Erro ao excluir o aluno.');
            }
        }

        return redirect()->route('admin.dashboard.student.index');
    }

    public function destroySelectedForced(Request $request)
    {
        if (!Auth::user()->can(['usuario.visualizar','usuario.remover'])) {
            return view('Admin.error.403');
        }

        if($deletedForever = Student::whereIn('id', $request->deleteAllForever)->forceDelete()){
            return Response::json
            (
                [
                    'status' => 'success',
                    'message' => $deletedForever.' itens deletados com sucessso!'
                ]
            );
        }
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['aluno.visualizar','aluno.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Student::whereIn('id', $request->deleteAll)->delete()){
            return Response::json
            (
                [
                    'status' => 'success',
                    'message' => $deleted.' itens deletados com sucessso!'
                ]
            );
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Student::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }

    public function retoreData($id){
        if (!Auth::user()->can(['aluno.visualizar','aluno.restaurar dados'])) {
            return view('Admin.error.403');
        }
        $user = Student::onlyTrashed()->where('id', $id);
        $user->restore();

        Session::flash('success','Registro restaurado com sucesso!');
        Session::flash('reopenModal','modal-student');
        return redirect()->route('admin.dashboard.student.index');
    }

    public function retoreDataAll(Request $request)
    {
        if (!Auth::user()->can(['aluno.visualizar','restaurar dados'])) {
            return view('Admin.error.403');
        }

        if($restored = Student::whereIn('id', $request->restoreAll)->restore()){
            return Response::json
            (
                [
                    'status' => 'success',
                    'message' => $restored.' itens restaurados com sucessso!'
                ]
            );
        }
    }
}
