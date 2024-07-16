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
        $this->middleware('auth');
        $this->middleware('role:super_admin');
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
        $role->update(['name' => $request->name]);
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

     // Methods for managing permissions
     public function permissionsIndex()
     {
         $permissions = Permission::all();
         return view('role-permission.permissions.index', compact('permissions'));
     }
 
     public function createPermission()
     {
         return view('role-permission.permissions.create');
     }
 
     public function storePermission(Request $request)
     {
         Permission::create(['name' => $request->name]);
         return redirect()->route('role-permission.permissions.index')->with('success', 'Permission created successfully');
     }
 
     public function editPermission($id)
     {
         $permission = Permission::find($id);
         return view('role-permission.permissions.edit', compact('permission'));
     }
 
     public function updatePermission(Request $request, $id)
     {
         $permission = Permission::find($id);
         $permission->update(['name' => $request->name]);
         return redirect()->route('role-permission.permissions.index')->with('success', 'Permission updated successfully');
     }
 
     public function destroyPermission($id)
     {
         Permission::find($id)->delete();
         return redirect()->route('role-permission.permissions.index')->with('success', 'Permission deleted successfully');
     }
}
