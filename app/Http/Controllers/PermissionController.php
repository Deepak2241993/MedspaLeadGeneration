<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:view permission',['only' => ['index']]);
        $this->middleware('permission:create permission',['only' => ['create','store']]);
        $this->middleware('permission:edit permission',['only' => ['edit','update']]);
        $this->middleware('permission:delete permission',['only' => ['destroy']]);
    }

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
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('role-permission.permissions.index')->with('success', 'Permission created successfully');
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('role-permission.permissions.edit', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);

        return redirect()->route('role-permission.permissions.index')->with('success', 'Permission updated successfully');
    }

    public function destroyPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('role-permission.permissions.index')->with('success', 'Permission deleted successfully');
    }
}
