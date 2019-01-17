<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/users-index', ['users' => $users]);
    }
    
    public function create()
    {
         return view('admin/users-create');
    }
    
    public function store(Request $request)
    {
         $user = new User;
         $user->name = $request->input('name');
         $user->password = bcrypt($request->input('password'));
         $user->email = $request->input('email');
         $user->type = $request->input('type');
         $user->save();
         return redirect('admin/users/' . $user->id);
    }
    
    public function show(User $user)
    {
         return view('admin/users-show', ['user' => $user]);
    }
    
    public function edit(User $user)
    {
        return view('admin/users-edit', ['user' => $user]);
    }
    
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect('admin/users/' . $user->id);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users');
    }
}
