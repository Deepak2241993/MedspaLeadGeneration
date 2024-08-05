<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:view user',['only' => ['index']]);
        $this->middleware('permission:create user',['only' => ['create','store']]);
        $this->middleware('permission:edit user',['only' => ['edit','update']]);
        $this->middleware('permission:delete user',['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', [
            'users' => $users
        ]);
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create', [
            'roles' => $roles
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|max:20',
            'roles' => 'required|array', // Ensure roles is an array
            'roles.*' => 'exists:roles,name' // Ensure each role exists in the roles table
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Sync roles
        $user->syncRoles($request->roles);
    
        return redirect('/users')->with('status', 'User created successfully');
    }
    
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure email uniqueness, excluding the current user
            'password' => 'nullable|string|min:5|max:20', // Password is optional for update
            'roles' => 'required|array', // Ensure roles is an array
            'roles.*' => 'exists:roles,name' // Ensure each role exists in the roles table
        ]);
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
        $user->syncRoles($request->roles);
    
        return redirect('/users')->with('status', 'User updated successfully');
    }

    public function destroy($userId)
    {
        $user = User::findorfail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'Users Delete Successfully');
    }
    
}
