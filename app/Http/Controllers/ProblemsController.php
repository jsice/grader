<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;

class ProblemsController extends Controller
{
    public function index() {
        $problems = \App\Problem::all();
        return view('problems.index', ['problems' => $problems]);
    }

    public function show($id){
        $problem = Problem::findOrFail($id);
        return view('problems.show', ['problem' => $problem]);
    }

    public function update(){

    }
}
