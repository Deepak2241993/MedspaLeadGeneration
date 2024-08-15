<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:permission_view',['only' => ['index']]);
        $this->middleware('permission:permission_create',['only' => ['create','store']]);
        $this->middleware('permission:permission_edit',['only' => ['edit','update']]);
        $this->middleware('permission:permission_delete',['only' => ['destroy']]);
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
            'module' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'required|string|max:255',
        ]);
    
        foreach ($request->permissions as $permission) {
            // Create a unique permission name by combining the module and permission name
            $permissionName = "{$request->module}_{$permission}";
    
            // Check if the permission already exists for the module
            if (!Permission::where('name', $permissionName)->exists()) {
                // If it doesn't exist, create the permission
                Permission::create([
                    'name' => $permissionName,
                    'module_name' => $request->module,
                ]);
            } else {
                // Optionally, you can add a message for skipped permissions
                // return redirect()->back()->withErrors([
                //     'error' => "The `{$permission}` permission already exists for the module `{$request->module}`."
                // ]);
            }
        }
    
        return redirect()->route('role-permission.permissions.index')->with('success', 'Permissions created successfully for the module.');
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
