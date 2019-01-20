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

    public $timeout = 1;
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
        // set_time_limit(1);
        $submissions_dir = storage_path('app\\submissions');
        $testsets_dir = storage_path('app\\problems')."\\".$this->submission->problem->id."\\problemtestset";
        $code_file = $submissions_dir."\\".$this->submission->file_path;
        $testsets = $this->submission->problem->testsets;
        $lang = $this->submission->language;
        $this->timeout = 1;
        $cnt = 1;
        foreach ($testsets as $testset) {
            $input_file = $testsets_dir."\\".$testset->input_path;
            $output_file = $testsets_dir."\\".$testset->output_path;
            $executable_name = $this->submission->id."_".$cnt;
            $is_yes = false;
            if ($lang == 'c') {
                shell_exec("gcc $code_file -o ".$executable_name.".exe 2>".$executable_name."_error.txt");
                $error = file_get_contents($executable_name."_error.txt");
                if (trim($error) == '') {
                    $input = file_get_contents($input_file);
                    $output = shell_exec($executable_name.".exe <\"$input_file\" 2>".$executable_name."_error2.txt");
                    $error2 = file_get_contents($executable_name."_error2.txt");
                    if (trim($error2) == '') {
                        $answer = file_get_contents($output_file);
                        if (trim($answer) == trim($output)) {
                            $this->submission->status = "YES";
                            $is_yes = true;
                        } else {
                            $this->submission->status = "NO:WrongAnswer";
                        }
                    } else {
                        $this->submission->status = "NO:RunTimeError";
                    }
                } else {
                    $this->submission->status = "NO:CompilationError";
                }
                shell_exec("del $executable_name.exe $executable_name"."_error.txt $executable_name"."_error2.txt");
            } else if ($lang == 'cpp') {
                shell_exec("g++ $code_file -o ".$executable_name.".exe 2>".$executable_name."_error.txt");
                $error = file_get_contents($executable_name."_error.txt");
                if (trim($error) == '') {
                    $input = file_get_contents($input_file);
                    $output = shell_exec($executable_name.".exe <\"$input_file\" 2>".$executable_name."_error2.txt");
                    $error2 = file_get_contents($executable_name."_error2.txt");
                    if (trim($error2) == '') {
                        $answer = file_get_contents($output_file);
                        if (trim($answer) == trim($output)) {
                            $this->submission->status = "YES";
                            $is_yes = true;
                        } else {
                            $this->submission->status = "NO:WrongAnswer";
                        }
                    } else {
                        $this->submission->status = "NO:RunTimeError";
                    }
                } else {
                    $this->submission->status = "NO:CompilationError";
                }
                shell_exec("del $executable_name.exe $executable_name"."_error.txt $executable_name"."_error2.txt");
            } else if ($lang == 'java') {
                $code_filename = explode("/", explode(".", $code_file)[0]);
                $code_filename = $code_filename[count($code_filename)-1];
                $code_dir = $submissions_dir."\\".explode("/", $this->submission->file_path)[0];
                shell_exec("javac $code_file 2>".$executable_name."_error.txt");
                $error = file_get_contents($executable_name."_error.txt");
                if (trim($error) == '') {
                    $input = file_get_contents($input_file);
                    $output = shell_exec("java -cp $code_dir $code_filename <\"$input_file\" 2>".$executable_name."_error2.txt");
                    $error2 = file_get_contents($executable_name."_error2.txt");
                    if (trim($error2) == '') {
                        $answer = file_get_contents($output_file);
                        if (trim($answer) == trim($output)) {
                            $this->submission->status = "YES";
                            $is_yes = true;
                        } else {
                            $this->submission->status = "NO:WrongAnswer";
                        }
                    } else {
                        $this->submission->status = "NO:RunTimeError";
                    }
                } else {
                    $this->submission->status = "NO:CompilationError";
                }
                shell_exec("del $code_dir\\$code_filename.class $executable_name"."_error.txt $executable_name"."_error2.txt");
            }
            if (!$is_yes) {
                break;
            }
            $cnt = $cnt + 1;
        }
        if ($this->submission->status != "NO:TimeLimitExceeded") {
            $this->submission->save();
        }
    }
}
