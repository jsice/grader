<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\ProblemTestSet;
use Illuminate\Support\Facades\Auth;

class ProblemsController extends Controller
{
    public function index() {
        $problems = Problem::all();
        return view('problems.index', ['problems' => $problems]);
    }

    public function show($id){
        $problem = Problem::findOrFail($id);
        return view('problems.show', ['problem' => $problem]);
    }

    public function create()
    {
        return view('problems.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'pdfFile' => 'required',
            'inputFiles' => 'required',
            'outputFiles' => 'required',
            'time' => 'required',
        ]);
        $problem = new Problem;
        $problem->admin_id = Auth::user()->id;
        $problem->name = $request->input('name');
        $problem->pdf_path = $problem->name.'.pdf';
        $problem->time = $request->input('time');
        $problem->status = 'show';
        $problem->save();
        $request->file('pdfFile')->storeAs("problems/$problem->id/", "$problem->name.pdf");

        $inputFiles=$request->file('inputFiles');
        $outputFiles=$request->file('outputFiles');

        foreach($inputFiles as $inputFile){
            $testSet = new ProblemTestSet;
            $inputName = explode( '.', $inputFile->getClientOriginalName());
            foreach($outputFiles as $outputFile){
                $outputName = explode( '.', $outputFile->getClientOriginalName());
                if ($inputName[0] == $outputName[0]){
                    $testSet->problem_id = $problem->id;
                    $upload = $inputFile->storeAs("problems/$problem->id/problemtestset/",$inputFile->getClientOriginalName());
                    $upload = $outputFile->storeAs("problems/$problem->id/problemtestset/",$outputFile->getClientOriginalName());
                    $testSet->input_path = '' . $inputFile->getClientOriginalName();
                    $testSet->output_path = '' . $outputFile->getClientOriginalName();
                    $testSet->save();
                }
            }
        }
        return redirect('problems/' . $problem->id);
    }

    public function destroy($id){
        $problem = Problem::findOrFail($id);
        $problem->delete();
        return redirect('/problems');
    }

    public function updateStatus(Request $request, $id){
        $problem = Problem::findOrFail($id);
        $problem->status = $request->input('status');
        $problem->save();
    }
}
