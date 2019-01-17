<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;

class SubmissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $submissions = \App\Submission::all();
        return view('submissions.index', compact('submissions'));
    }
    
    public function create($id)
    {
        $problem = Problem::findOrFail($id);
        return view('submissions.create', compact('problem'));
    }
    
    public function store(Request $request)
    {
        //  $submission = new Submission;
        //  $submission->user_id = $request->input('user_id');
        //  $submission->problem_id = $request->input('problem_id');
        //  $submission->file_path = $request->input('file_path');
        //  $submission->status = 'PENDING';
        //  $submission->save();
        $validatedData = $request->validate([
            'codeFile' => 'required',
            'language' => 'required',
        ]);
        $codeFile = $request->file('file');
        $language = $request->input('language');
        var_dump($codeFile);
        var_dump($language);
        // return redirect('submissions');
    }
    
    public function show(Submission $submission)
    {
        return view('submissions.show', compact('submissions'));
    }

    public function edit(Submission $submission)
    {
        return view('submissions.edit', compact('submissions'));
    }
    
    public function update(Request $request, Submission $submission)
    {
        $submission->status = $request->input('status');
        $submission->save();
        return redirect('submissions/'.$submission->id);
    }
}
