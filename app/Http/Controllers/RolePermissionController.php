<?php

// app/Http/Controllers/RolePermissionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:view permission',['only' => ['index']]);
        $this->middleware('permission:create role',['only' => ['create','store']]);
        $this->middleware('permission:view permission',['only' => ['index']]);
        $this->middleware('permission:view permission',['only' => ['index']]);
    }

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role-permission.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        return view('role-permission.roles.create');
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('role-permission.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        // $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role:: findorfail($roleId);
        return view('role-permission.roles.add-permissions',
        ['role'=> $role, 'permissions' => $permissions ]);
    }

     
}
