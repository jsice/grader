<?php

use Faker\Generator as Faker;

$factory->define(App\Problem::class, function (Faker $faker) {
    $admin = \App\User::where('type', 'admin')->get()->random();
    return [
        'admin_id' => $admin->id, 
        'name' => $faker->name, 
        'pdf_path' => 'Cal_I.pdf',
        'status' => $faker->randomElement(['show', 'hide'])
    ];
});
