<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \App\User;
class ScoreboardController extends Controller
{
    public function index() {
        $users = \App\User::where('type', 'student')->get();
        $problems = \App\Problem::all();
        $submissions = \App\Submission::where('status', 'YES')->get();
        $submissions_no = \App\Submission::whereIn('status', array('NO:TimeLimitExceeded', 'NO:CompilationError', 'NO:RunTimeError', 'NO:WrongAnswer', 'NO:ContactTA'))->get();
        $scoreboard = array();
        foreach ($users as $user) {
            $scoreboard[$user->id] = array();
            foreach ($problems as $problem) {
                $scoreboard[$user->id][$problem->id] = -1;
            }
            $scoreboard[$user->id]['time'] = 'None';
            $scoreboard[$user->id]['total'] = 0;
        }

        foreach ($submissions_no as $submission) {
            if ($submission->sender->type == 'student') {
                $scoreboard[$submission->sender->id][$submission->problem_id] = 0;
            }
        }


        foreach ($submissions as $submission) {
            if ($submission->sender->type == 'student') {
                $scoreboard[$submission->sender->id][$submission->problem_id] = 1;
                if ($scoreboard[$submission->sender->id]['time'] != 'None') {
                    if ($scoreboard[$submission->sender->id]['time']->lt($submission->updated_at)) {
                        $scoreboard[$submission->sender->id]['time'] = $submission->updated_at;
                    }
                } else {
                    $scoreboard[$submission->sender->id]['time'] = $submission->updated_at;
                }
            }
        }
        foreach ($users as $user) {
            foreach ($problems as $problem) {
                if ($scoreboard[$user->id][$problem->id] == 1) {
                    $scoreboard[$user->id]['total'] = $scoreboard[$user->id]['total'] + 1;
                }
            }
        }
        uasort($scoreboard, function($item1, $item2) {
            if ($item2['total'] <=> $item1['total']) {
                return $item2['total'] <=> $item1['total'];
            }
            return $item1['time'] <=> $item2['time'];
        });
        // uasort($scoreboard, function($item1, $item2) {
        //     return $item2['total'] <=> $item1['total'];
        // });
        foreach ($scoreboard as $key => $value) {
          unset($scoreboard[$key]['time']);
        }
        return view('scoreboard', compact('scoreboard', 'problems'));
    }
}
