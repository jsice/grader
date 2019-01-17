<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\Submission;
use Illuminate\Support\Facades\Auth;
use App\Jobs\RunCode;

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
    
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'codeFile' => 'required',
            'language' => 'required',
        ]);

        $codeFile = $request->file('codeFile');

        $submission = new Submission;
        $submission->user_id = Auth::user()->id;
        $submission->problem_id = $id;
        $submission->status = 'PENDING';
        $submission->language = $request->input('language');
        $submission->save();

        $fileName = $submission->id . '_' . $id . '_' . Auth::user()->id. '_' . Auth::user()->std_id . '.' . $codeFile->getClientOriginalExtension();
        $submission->file_path = $fileName;
        $submission->save();

        //Display File Name
        echo 'File Name: '.$codeFile->getClientOriginalName();
        echo '<br>';
   
        //Display File Extension
        echo 'File Extension: '.$codeFile->getClientOriginalExtension();
        echo '<br>';
    
        //Display File Real Path
        echo 'File Real Path: '.$codeFile->getRealPath();
        echo '<br>';
    
        //Display File Size
        echo 'File Size: '.$codeFile->getSize();
        echo '<br>';
    
        //Display File Mime Type
        echo 'File Mime Type: '.$codeFile->getMimeType();

        //Move Uploaded File
        $destinationPath = 'submissions';
        $codeFile->storeAs($destinationPath, $fileName);

        RunCode::dispatch($submission);

        return redirect('submissions');
    }
    
    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        return view('submissions.show', ['submission' => $submission]);
    }

    public function edit(Submission $submission, $id)
    {
        return view('submissions.edit', compact('submission', 'id'));
    }
    
    public function update(Request $request, Submission $submission)
    {
        $submission->status = $request->input('status');
        $submission->save();
        return redirect('submissions/'.$submission->id);
    }
}
