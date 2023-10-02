<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;
// use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/user/';

    public function index()
    {   
        if(Auth::user()->can('usuario.criar') || Auth::user()->can('usuario.editar') || 
            Auth::user()->can('usuario.visualizar') || Auth::user()->can('usuario.remover'))
        {            
            $users = User::where('id', '<>', 1)->sorting()->paginate(15);
            $currentRole = Role::join('model_has_roles', 'roles.id', 'model_has_roles.role_id')->get();
            $otherRoles = Role::whereNotIn('id', $currentRole->pluck('id'))->get();
            $permissions = Permission::join('role_has_permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->groupBy('permissions.name')
            ->select('permissions.name')
            ->get();
            $userDeleteds_at = User::onlyTrashed()->get();
            
            return view('Admin.cruds.user.index', [
                'users'=>$users,
                'otherRoles'=>$otherRoles,
                'permissions'=>$permissions,
                'currentRole'=>$currentRole,
                'userDeleteds_at'=>$userDeleteds_at
                
            ]);
        }else if(!Auth::user()->can(['usuario.criar', 'usuario.editar','usuario.visualizar', 'usuario.remover']))
        {
            return view('Admin.error.403');            
        }

    }

    public function create()
    {  
        if(Auth::user()->can('usuario.criar'))
        { 
            $roles = Role::all();
            $currentRole = '';
            $otherRoles = '';

            return view('Admin.cruds.user.create', [
                'roles'=>$roles,
                'currentRole'=>$currentRole,
                'otherRoles'=>$otherRoles,
                'roles'=>$roles
            ]);
        }else{
            return view('Admin.error.403');
        }        
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();
        $roles = $request->validated()['roles']??[];

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {$data['path_image'] = $this->pathUpload . $path_image;}
            $data['password'] = Hash::make($request->password);
            $data['active'] = $request->active ? 1 : 0;

            $userExist = User::where('email', $data['email'])->first();

            if ($userExist) {
                Storage::delete($this->pathUpload . $path_image);

                return redirect()->back()->with('error', 'Erro ao cadastrar usuário! Este e-mail já existe em nossos registros.');
            } else {
                $user = User::create($data);
                $user->syncRoles($roles);
    
                if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
                Session::flash('success', 'Usuário cadastrado com sucesso!');
            }

            DB::commit();
            return redirect()->route('admin.dashboard.user.index');
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o Usuário!');
            return redirect()->back();
        }
    }

    public function edit(User $user)
    {  
        if(Auth::user()->can('usuario.editar')){ 
            
            $currentRole = Role::join('model_has_roles', 'roles.id', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', $user->id)->get();
            $otherRoles = Role::whereNotIn('id', $currentRole->pluck('id'))->get(); 

            return view('Admin.cruds.user.edit', [
                'user' => $user,
                'otherRoles' => $otherRoles,
                'currentRole' => $currentRole,
            ]);
        }else {
            return view('Admin.error.403');
        }        
    }
    public function show(User $user){
        $user = User::find('id');

        return redirect()->route('admin.dashboard.user.show')->with($user);
    }
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        $helper = new HelperArchive();
        $roles = $request->validated()['roles']??[];
        
        if (Auth::user()->hasRole('Super') && $user->id == 1) {
            $roles[] = 'Super';
        }

        try {
            DB::beginTransaction();
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) $data['path_image'] = $this->pathUpload . $path_image;
            if ($path_image) {
                Storage::delete($user->path_image);
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($user->$inputFile);
                $data['path_image'] = null;
            }

            $data['password'] = Hash::make($request->password);
            $data['active'] = $request->active ? 1 : 0;
            if($request->password == '') unset($data['password']);

            $user->fill($data)->save();
            $user->syncRoles($roles);

            if ($path_image) {Storage::delete($this->pathUpload.$path_image);}
            if ($path_image) {$request->file('path_image')->storeAs($this->pathUpload, $path_image);}
            DB::commit();
            Session::flash('success', 'Usuário atualizado com sucesso!');
            return redirect()->route('admin.dashboard.user.index');
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o Usuário!');
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message-error'=>$exception->getMessage()]);
        }
    }

    public function destroy(User $user)
    { 
        if(!Auth::user()->can('usuario.remover')){
            return view('Admin.error.403');
        }
        Storage::delete($user->path_image);
        $user->delete();
        
        Session::flash('success','Usuário deletado com sucesso!');
        return redirect()->back();
    }
    public function deleteForced($id)
    { 
        if (!Auth::user()->can('usuario.remover')) {
            return view('Admin.error.403');
        }
    
        $user = user::withTrashed()->find($id);
        if ($user) {
            // Verifique se o usuário autenticado tem permissão para excluir permanentemente o user (opcional)
            // ...
            
            try {
                $user->forceDelete();
                Session::flash('success', 'Usuário excluído com sucesso!');
                Session::flash('reopenModal','modal-user');
            } catch (\Exception $e) {
                Session::flash('error', 'Erro ao excluir o usuário.');
            }
        }

        return redirect()->route('admin.dashboard.user.index');
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can('usuario.remover')) {
            return view('Admin.error.403');
        }

        if($deleted = User::whereIn('id', $request->deleteAll)->delete()){            
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            User::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }

    public function retoreData($id){
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();

        Session::flash('success','Registro restaurado com sucesso!');
        Session::flash('reopenModal','modal-user');
        return redirect()->route('admin.dashboard.user.index');
    }
}
