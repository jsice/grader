<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\User;
use App\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Jobs\SendToJudge;

class SubmissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $problems = Problem::all();
        $users = User::all();
        $status = ['YES', 'NO:TimeLimitExceeded', 'NO:CompilationError', 'NO:RunTimeError', 'NO:WrongAnswer', 'NO:ContactTA', 'DELETED', 'PENDING'];
        $params = array('problems'=>array(),'sender'=>array(),'status'=>array());
        if (Auth::user()->type === "student") {
            $submissions = Submission::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
        } else if (Auth::user()->type === "admin") {
            $submissions = Submission::where('id', '>=', '0');
            $filtered_problems = Input::get('problems');
            if ($filtered_problems !== null) {
                $filtered_problems = explode(',', $filtered_problems);
                $submissions = $submissions->whereIn('problem_id', $filtered_problems);
                $params['problems'] = $filtered_problems;
            }
            $filtered_sender = Input::get('sender');
            if ($filtered_sender !== null) {
                $filtered_sender = explode(',', $filtered_sender);
                $submissions = $submissions->whereIn('user_id', $filtered_sender);
                $params['sender'] = $filtered_sender;
            }
            $filtered_status = Input::get('status');
            if ($filtered_status !== null) {
                $filtered_status = explode(',', $filtered_status);
                $submissions = $submissions->whereIn('status', $filtered_status);
                $params['status'] = $filtered_status;
            }
            $submissions = $submissions->orderBy('id', 'DESC')->paginate(15);
        }
        return view('submissions.index', [
            'submissions' => $submissions->appends(Input::except('page')), 'problems' => $problems, 'users' => $users, 'status' => $status, 'params' => $params
        ]);
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
