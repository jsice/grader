<?php

use Faker\Generator as Faker;

$factory->define(App\Submission::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random(), 
        'problem_id' => \App\Problem::all()->random(), 
        'file_path' => 'mock.java', 
        'language' => 'java',
        'status' => $faker->randomElement(['YES', 'NO:TimeLimitExceeded', 'NO:CompilationError', 'NO:RunTimeError', 'NO:WrongAnswer', 'NO:ContactTA'])
    ];
});
