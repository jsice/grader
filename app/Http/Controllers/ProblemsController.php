<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
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
            'pdf_file' => 'required',
        ]);
        $problem = new Problem;
        $problem->admin_id = Auth::user()->std_id;
        $problem->name = $request->input('name');
        $upload = $request->file('pdfFile')->storeAs('',$problem->name);
        $problem->pdf_path = '' . $problem->name;
        $problem->status = 'show';
        $problem->save();

        $inputFiles=$request->file('inputFiles');
        $outputFiles=$request->file('outputFiles');

        foreach($inputFiles as $inputFile){
            $testSet = new ProblemTestSet;
            $inputName = explode( '.', $inputFile->getClientOriginalName());
            foreach($outputFiles as $outputFile){
                $outputName = explode( '.', $outputFile->getClientOriginalName());
                if ($inputName[0] == $outputName[0]){
                    $testSet->problem_id = $problem->id;
                    $upload = $inputFile->storeAs('',$inputFile->getClientOriginalName());
                    $upload = $outputFile->storeAs('',$outputFile->getClientOriginalName());
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
