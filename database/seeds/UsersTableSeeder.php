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
        $admin->name = 'Wiwadh Chinanuphandh';
        $admin->email = 'wiwadh.c@ku.th';
        $admin->type = 'admin';
        $admin->std_id = '5810400051';
        $admin->save();
    }
}
