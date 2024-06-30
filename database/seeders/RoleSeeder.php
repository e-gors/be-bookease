<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Customer', 'Service Provider'];

        foreach ($roles as $roleName) {
            // Check if the role already exists
            $existingRole = Role::where('name', $roleName)->first();

            if (!$existingRole) {
                // Create role
                Role::create(['name' => $roleName]);
            }
        }

    }
}
