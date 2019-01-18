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
        $submissions = Submission::orderBy('id', 'DESC')->paginate(15);
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

    public function edit($id)
    {
        $submission = Submission::findOrFail($id);
        return view('submissions.edit', compact('submission', 'id'));
    }
    
    public function update(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = $request->input('status');
        $submission->save();
        return redirect('submissions/'.$submission->id);
    }
}
