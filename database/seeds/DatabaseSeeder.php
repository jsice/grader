<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(ProblemsTableSeeder::class);
        // $this->call(ProblemTestSetsTableSeeder::class);
        // $this->call(SubmissionsTableSeeder::class);
    }
}
