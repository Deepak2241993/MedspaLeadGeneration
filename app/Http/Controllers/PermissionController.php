<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;


class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin');
    }

    public function permissionsIndex()
     {
         $permissions = Permission::all();
         return view('permissions.index', compact('permissions'));
     }
 
     public function createPermission()
     {
         return view('permissions.create');
     }
 
     public function storePermission(Request $request)
     {
         Permission::create(['name' => $request->name]);
         return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
     }
 
     public function editPermission($id)
     {
         $permission = Permission::find($id);
         return view('permissions.edit', compact('permission'));
     }
 
     public function updatePermission(Request $request, $id)
     {
         $permission = Permission::find($id);
         $permission->update(['name' => $request->name]);
         return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
     }
 
     public function destroyPermission($id)
     {
         Permission::find($id)->delete();
         return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
     }
}
