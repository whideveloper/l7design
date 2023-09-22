<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RequestStoreRoles;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\RequestUpdateRoles;

class RoleController extends Controller
{
    public function index()
    {        
        if(Auth::user()->can('grupo.criar') || Auth::user()->can('grupo.editar') || 
            Auth::user()->can('grupo.visualizar') ||  Auth::user()->can('grupo.remover'))
        {
            $roles = Role::paginate(15);
            $permissions = Permission::join('role_has_permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->groupBy('permissions.name')
            ->select('permissions.name')
            ->get(); 

            return view('Admin.cruds.group.index', [
                'roles'=>$roles,
                'permissions'=>$permissions
            ]);
        }else if(!Auth::user()->can(['grupo.criar', 'grupo.editar','grupo.visualizar', 'grupo.remover']))
        {
            return view('Admin.error.403');            
        }
    }
    public function create()
    {   
        if (Auth::user()->can('grupo.criar')) {
            $permissions = Permission::all();
            return view('Admin.cruds.group.create', [
                'permissions'=>$permissions
            ]);
        }else{
             return view('Admin.error.403');
        }         
    }
    public function store(RequestStoreRoles $request)
    {  
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permissions);
        Session::flash('success','Grupo cadastrado com sucesso!');
        return redirect()->route('admin.dashboard.group.index');
    }
    public function edit(Request $request,Role $role)
    {   
        if(Auth::user()->can('grupo.editar')){
            $permissions = Permission::all();
            return view('Admin.cruds.group.edit', [
                'role'=>$role,
                'permissions'=>$permissions
            ]);
        }else{
            return view('Admin.error.403');
        }         
    }

    public function show(Role $role){
        $role = Role::find('id');

        return redirect()->route('admin.dashboard.group.show')->with($role);

    }
    public function update(RequestUpdateRoles $request,Role $role)
    {
        try{
            DB::beginTransaction();
            $role->update([
                'name'=>$request->name,
                'description'=>$request->description
            ]);
            $role->syncPermissions($request->permissions);
            DB::commit();
            Session::flash('success','Grupo alterado com sucesso!');
            return redirect()->route('admin.dashboard.group.index');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Request $request,Role $role)
    {
        if(!Auth::user()->can('grupo.remover')){
            return view('Admin.error.403');
        } 

        $role->delete();
        Session::flash('success','Grupo deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if($deleted = Role::whereIn('id', $request->deleteAll)->delete()){
            
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {   
        if(!Auth::user()->can('grupo.remover')){
            return view('Admin.error.403');
        }

        foreach($request->arrId as $sorting => $id){
            Role::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
