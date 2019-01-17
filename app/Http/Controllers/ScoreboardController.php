<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \App\User;
class ScoreboardController extends Controller
{
    public function index() {
        $userScores = Array();
        $users = \App\User::all();
        // foreach ($users as $user){
        //     $id = $user->id;
        //     $userScores[$id] = 0;
        // }

        // $submissions = \App\Submission::all();
        // foreach ($submissions as $submission){
        //     if ($submission->status == ''){
        //         $userScores[$submission->user_id] += 1;
        //     }
        // }

        // arsort($userScores);

        // foreach ($userScores as $userScore){
            
        // }
        return $users;
    }
}
