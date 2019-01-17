<?php

use Illuminate\Database\Seeder;

class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Problem::class, 3)->create();
    }
}
