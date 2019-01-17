<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\User;
        $admin->password = bcrypt('adminpassword');
        $admin->name = 'ice';
        $admin->email = 'admin@ku.th';
        $admin->type = 'admin';
        $admin->std_id = '5810400051';
        $admin->save();
        $admin = new App\User;
        $admin->password = bcrypt('userpassword');
        $admin->name = 'ice2';
        $admin->email = 'user@ku.th';
        $admin->type = 'student';
        $admin->std_id = '6010400051';
        $admin->save();
        factory(App\User::class, 50)->create();
    }
}
