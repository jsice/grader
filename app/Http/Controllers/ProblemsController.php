<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'pdf_file' => 'required',
        ])
        $problem = new Problem;
        $problem->admin_id = Auth::user()->std_id;
        $problem->name = $request->input('name');
        $request->file('pdf_file')->storeAs('',$request->file('pdf_file')->getClientOriginalName());
        $problem->pdf_path = '' . $request->file('pdf_file')->getClientOriginalName();
        $problem->status = 'show';
        $problem->save();
        'problem_id', 'input_path', 'output_path'

        $inputFiles=$request->file('input_files')
        $outputFiles=$request->file('output_files')

        foreach($inputFiles as $inputFile){
            $testSet = new ProblemTestSet;
            $inputName = explode( '.', $inputFile->getClientOriginalName());
            foreach($outputFiles as $outputFile){
                $outputName = explode( '.', $outputFile->getClientOriginalName());
                if ($inputName[0] == $outputName[0]){
                    $testSet->problem_id = $problem->id;
                    $inputFile->storeAs('',$inputFile->getClientOriginalName());
                    $outputFile->storeAs('',$outputFile->getClientOriginalName());
                    $testSet->input_path = '' . $inputFile->getClientOriginalName();
                    $testSet->output_path = '' . $outputFile->getClientOriginalName();
                    $testSet->save();
                }
            }
        }
        return redirect('problems/' . $problem->id);
    }

    public function update(){

    }
}
