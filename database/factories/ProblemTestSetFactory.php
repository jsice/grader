<?php

use Faker\Generator as Faker;

$factory->define(App\ProblemTestSet::class, function (Faker $faker) {
    $problem = \App\Problem::all()->random();
    $n = $faker->unique()->randomDigit;
    return [
        'problem_id' => $problem->id, 
        'input_path' => $n.'.in', 
        'output_path' => $n.'.ans'
    ];
});
