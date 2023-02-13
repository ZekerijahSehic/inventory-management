<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $validete = $request->validate(['name' => ['required']]);
        Role::create($validete);

        return to_route('roles.index');
    }

    public function edit(Role $role){

        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role){
        $validete = $request->validate(['name' => ['required']]);
        $role->update($validete);
        return to_route('roles.index');
    }

    public function destroy(Role $role){
        $role->delete();
        return back()->with('message', 'Role deleted');
    }

    public function givePermission(Request $request, Role $role){
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added');
    }

    public function revokePermission(Role $role, Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked');
        }
        return back()->with('message', 'Permission not exist');
    }
}
