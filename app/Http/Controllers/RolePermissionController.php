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
        $this->middleware('permission:role_view',['only' => ['index']]);
        $this->middleware('permission:role_create',['only' => ['create','store']]);
        $this->middleware('permission:role_edit',['only' => ['edit','update']]);
        $this->middleware('permission:role_delete',['only' => ['destroy']]);
        $this->middleware('permission:role_permissiontorole',['only' => ['addPermissionToRole']]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_numbers' => 'required|string', 
        ]);

        // Create the role
        $role = Role::create([
            'name' => $request->name,
        ]);
        $phoneNumbers = explode(',', $request->phone_numbers); 
        $phoneNumbers = array_map('trim', $phoneNumbers); 
        $role->phone_numbers = implode(', ', $phoneNumbers); 
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }



    public function edit($id)
    {
        $role = Role::find($id);
        // $permissions = Permission::all();
        return view('role-permission.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone_numbers' => 'required|string',
        ]);

        $role->update(['name' => $request->name]);

        $phoneNumbers = explode(',', $request->phone_numbers); 
        $phoneNumbers = array_map('trim', $phoneNumbers);

        $role->phone_numbers = implode(', ', $phoneNumbers);

        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function moduleUpdate(Request $request, $id)
    {
        $role = Role::find($id);
        // $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Module Updated Successfully');
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
