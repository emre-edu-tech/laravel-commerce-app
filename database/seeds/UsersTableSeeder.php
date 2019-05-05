<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->role_id = 2;
        $admin->name = "Ahmet Dervişoğlu";
        $admin->email = "emrekayikcilar@gmail.com";
        $admin->password = Hash::make('1905abcd');

        $admin->save();
    }
}
