<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }
    
    public function create()
    {
         return view('users.create');
    }
    
    public function store(Request $request)
    {
         $user = new User;
         $user->name = $request->input('name');
         $user->std_id = $request->input('std_id');
         $user->password = bcrypt($request->input('password'));
         $user->email = $request->input('email');
         $user->type = 'admin';
         $user->save();
         return redirect('users');
    }
}
