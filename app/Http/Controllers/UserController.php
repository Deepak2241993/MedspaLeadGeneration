<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Mail\UserRoleUpdated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:user_view',['only' => ['index']]);
        $this->middleware('permission:user_create',['only' => ['create','store']]);
        $this->middleware('permission:user_edit',['only' => ['edit','update']]);
        $this->middleware('permission:user_delete',['only' => ['destroy']]);
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
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure email uniqueness, excluding the current user
            'roles' => 'required|array', // Ensure roles is an array
            'roles.*' => 'exists:roles,name' // Ensure each role exists in the roles table
        ]);
    
        // Prepare the data for updating the user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        // If a password is provided, hash it and add it to the update data
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
    
        // Update the user with the provided data
        $user->update($data);
    
        // Sync the roles for the user
        $user->syncRoles($request->roles);
    
        // Send an email notification to the user about the role update
        Mail::to($user->email)->send(new UserRoleUpdated($user));
    
        // Redirect back to the users page with a success message
        return redirect('/users')->with('success', 'User updated successfully and the email has been sent to them.');

    }
    

    public function destroy($userId)
    {
        $user = User::findorfail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'Users Delete Successfully');
    }
    
}
