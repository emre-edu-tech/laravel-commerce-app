<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = "Administator";
        $admin->description = "The users that belong to this role are resppnsible for administrative operations";
        $admin->save();

        $customer = new Role();
        $customer->name = "Customer";
        $customer->description = "Users that normally registered on the website will belong to this role and can make orders.";
        $customer->save();
    }
}
