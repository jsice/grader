<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin'], ['except' => ['show']]);
    }

    public function index()
    {
        $students = User::where('type', 'student')->paginate(10, ['*'], 'students');
        $admins = User::where('type', 'admin')->paginate(10, ['*'], 'admins');
        return view('users.index', compact('students', 'admins'));
    }

    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }
    
    public function create()
    {
        return view('users.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'std_id' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->std_id = $request->input('std_id');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->type = 'admin';
        $user->save();
        return redirect('users');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->type = 'admin';
        $user->save();
        return redirect('/users');
    }
}
