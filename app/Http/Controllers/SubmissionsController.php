<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\Submission;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendToJudge;

class SubmissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()->type === "student") {
            $submissions = Submission::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
        } else if (Auth::user()->type === "admin") {
            $submissions = Submission::orderBy('id', 'DESC')->paginate(15);
        }
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
            'language' => 'required',
        ]);

        $lang = $request->input('language');

        $validatedData = $request->validate([
            'codeFile' => 'required',
        ]);

        $codeFile = $request->file('codeFile');

        $submission = new Submission;
        $submission->user_id = Auth::user()->id;
        $submission->problem_id = $id;
        $submission->status = 'PENDING';
        $submission->language = $lang;
        $submission->save();

        $fileName = $submission->id . '_' . $id . '_' . Auth::user()->id. '_' . Auth::user()->std_id . '/' . $codeFile->getClientOriginalName();
        $submission->file_path = $fileName;
        $submission->save();

        $destinationPath = 'submissions';
        $codeFile->storeAs($destinationPath, $fileName);

        // RunCode::dispatch($submission);
        SendToJudge::dispatch($submission->id);
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

    public function rejudge(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = "PENDING";
        $submission->save();
        SendToJudge::dispatch($submission->id);
        return redirect('submissions/'.$id);
    }
}
