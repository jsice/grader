<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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
        $this->middleware(['is_admin']);
        $user = User::findOrFail($id);
        $user->type = 'admin';
        $user->save();
        return redirect('/users');
    }

    public function setStdID(Request $request)
    {
        $validatedData = $request->validate([
            'std_id' => 'required|regex:/(5[2-9]|6[0-1])104(5|0)[0-9]{4}/',
        ]);
        $user = Auth::user();
        $user->std_id = $request->input('std_id');
        $user->save();
        return redirect('/profile');
    }
}
