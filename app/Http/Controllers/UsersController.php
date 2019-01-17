<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $students = User::where('type', 'student')->get();
        $admins = User::where('type', 'admin')->get();
        return view('users.index', compact('students', 'admins'));
    }
    
    public function create()
    {
         return view('users.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'std_id' => 'required',
            'language' => 'required',
        ]);
         $user = new User;
         $user->name = $request->input('name');
         $user->std_id = $request->input('std_id');
         $user->password = bcrypt($request->input('password'));
         $user->email = $request->input('email').'@ku.th';
         $user->type = 'admin';
         $user->save();
         return redirect('users');
    }
}
