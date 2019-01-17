<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    public function index()
    {
        $submissions = \App\Submission::all();
        return view('submissions.index', compact('submissions'));
    }
    
    public function create()
    {
         return view('submissions.create');
    }
    
    public function store(Request $request)
    {
        //  $submission = new Submission;
        //  $submission->user_id = $request->input('user_id');
        //  $submission->problem_id = $request->input('problem_id');
        //  $submission->file_path = $request->input('file_path');
        //  $submission->status = 'PENDING';
        //  $submission->save();
         return redirect('submissions');
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
