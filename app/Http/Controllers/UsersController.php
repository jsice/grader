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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->type = 'admin';
        $user->save();
        return redirect('/users');
    }
}
