<?php

namespace Database\Seeders;

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
        // RolestableSeeder should be called to store the default administrator and customer roles
        $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(Box_TypesTableSeeder::class);
        // $this->call(Package_TypesTableSeeder::class);
        // $this->call(Post_CategoriesTableSeeder::class);
    }
}
