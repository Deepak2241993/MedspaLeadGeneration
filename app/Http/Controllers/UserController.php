<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
            'roles' => 'required',

        ]);

        $users =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $users->syncRoles($request->roles);

        return redirect('/users')->with('status','User Create Seccusfully');
    }
    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }
    Public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'password' => 'required|string|min:5|max:20',
            'roles' => 'required',

        ]);
        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];
        if(!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }
        $user->update($data);
        $users->syncRoles($request->roles);

        return redirect('/users')->with('status','User Upadate Seccusfully');
    }
}
