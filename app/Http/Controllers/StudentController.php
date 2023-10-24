<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Student;
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
        $students = Student::sorting()->paginate(15);
        $roles = Role::paginate(15);
        $permissions = Permission::join('role_has_permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->groupBy('permissions.name')
            ->select('permissions.name')
            ->get();
        return view('Admin.cruds.student.index',[
            'students'=>$students,
            'roles'=>$roles,
            'permissions'=>$permissions
        ]);
    }
    public function create()
    {
        if (!Auth::user()->can(['aluno.visualizar','aluno.criar'])) {
            return view('Admin.error.403');
        }
        $permissions = Permission::all();
        return view('Admin.cruds.student.create', [
            'permissions'=>$permissions
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
            $data['password'] = Hash::make($request->password);
            $data['active'] = $request->active ? 1 : 0;

            $studentExist = Student::where('email', $data['email'])->first();

            if ($studentExist) {
                Storage::delete($this->pathUpload . $path_image);

                return redirect()->back()->with('error', 'Erro ao cadastrar aluno! Este e-mail já existe em nossos registros.');
            } else {
                $student = Student::create($data);

                if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
                Session::flash('success', 'Aluno cadastrado com sucesso!');
            }

            DB::commit();
            return redirect()->route('admin.dashboard.student.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Aluno!');
            return redirect()->back();
        }
    }

    public function show(Student $student)
    {
        if(!Auth::user()->can('aluno.visualizar')){
            return view('Admin.error.403');
        }
        $student = Student::find('id');

        return redirect()
            ->route('admin.dashboard.student.show')
            ->with($student);
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
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['aluno.visualizar','aluno.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Student::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Student::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }

}
