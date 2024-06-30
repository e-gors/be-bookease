<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AdminSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UsersSeeder::class);
    }
}
