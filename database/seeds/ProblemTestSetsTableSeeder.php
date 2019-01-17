<?php

use Illuminate\Database\Seeder;

class ProblemTestSetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProblemTestSet::class, 10)->create();
    }
}
