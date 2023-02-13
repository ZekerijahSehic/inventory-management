<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(){
        return view('admin.permissions.create');
    }

    public function store(Request $request){
        $valideted = $request->validate(['name' => 'required']);
        Permission::create($valideted);

        return to_route('permissions.index');
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission){
        $valideted = $request->validate(['name' => 'required']);
        $permission->update($valideted);
        return to_route('permissions.index');
    }

    public function destroy(Permission $permission){
        $permission->delete();
        return back()->with('message', 'Permission deleted');
    }
}
