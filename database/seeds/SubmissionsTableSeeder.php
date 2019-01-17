<?php

use Illuminate\Database\Seeder;

class SubmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            $submit = new App\Submission;
            $submit->user_id = \App\User::all()->random()->id;
            $submit->problem_id = \App\Problem::all()->random()->id;
            $submit->file_path = 'test.java';
            $submit->status = 'YES';
            $submit->save();
            sleep(1);
        }

        for ($i=0; $i < 100; $i++) { 
            factory(App\Submission::class, 1)->create();
            sleep(0.1);
        }
    }
}
