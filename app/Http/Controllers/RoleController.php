<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RequestIndexRoles;
use App\Http\Requests\RequestStoreRoles;
use App\Http\Requests\RequestUpdateRoles;
use Illuminate\Support\Facades\Response;

class RoleController extends Controller
{
    public function index()
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
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('Admin.cruds.group.create', [
            'permissions'=>$permissions
        ]);
    }
    public function store(RequestStoreRoles $request)
    {  
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.dashboard.group.index');
    }
    public function edit(Request $request,Role $role)
    {
        $permissions = Permission::all();

        return view('Admin.cruds.group.edit', [
            'role'=>$role,
            'permissions'=>$permissions
        ]);
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
            return redirect()->route('admin.dashboard.group.index');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Request $request,Role $role)
    {
        $role->delete();
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if($deleted = Role::whereIn('id', $request->deleteAll)->delete()){
            
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Role::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
