<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Submission;

class RunCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $timeout = 1;
    protected $submission;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit($this->submission->problem->time);
        // $code_file = $this->submission->file_path;
        // $testsets = $this->submission->problem->testsets;
        // $lang = $this->submission->language;
        // $cnt = 1;
        // foreach ($testsets as $testset) {
        //     $input_file = $testset->input_path;
        //     $output_file = $testset->output_path;
        //     $executable_name = $this->submission->id."_".$cnt;
        //     if ($lang == 'c') {
        //         shell_exec("gcc $code_file -o ".$executable_name.".exe 2>".$executable_name."_error.txt");
        //         $error = file_get_contents($executable_name."_error.txt");
        //         if (trim($error) == '') {
        //             $input = file_get_contents($input_file);
        //             $output = shell_exec($executable_name.".exe <$input 2>".$executable_name."_error2.txt");
        //             $error2 = file_get_contents($executable_name."_error2.txt");
        //             if (trim($error2) == '') {
        //                 $answer = file_get_contents($output_file);
        //                 if (trim($answer) == trim($output)) {
        //                     $this->submission->status = "YES";
        //                 } else {
        //                     $this->submission->status = "NO:WrongAnswer";
        //                 }
        //             } else {
        //                 $this->submission->status = "NO:RunTimeError";
        //             }
        //         } else {
        //             $this->submission->status = "NO:CompilationError";
        //         }
        //     } else if ($lang == 'cpp') {

        //     } else if ($lang == 'java') {

        //     }
        //     $cnt = $cnt + 1;
        // }
        $this->submission->status = "DELETED";
        $this->submission->save();
    }
}