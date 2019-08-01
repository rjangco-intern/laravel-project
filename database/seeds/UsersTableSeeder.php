<?php

use App\User;
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
        
        $user = New User;
        $user->name = 'Chomusuke';
        $user->email = 'chomusuke@suba.com';
        $user->password = bcrypt('admin');
        $user->is_admin = true;
        $user->save();

    }
}
