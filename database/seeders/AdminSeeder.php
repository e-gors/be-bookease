<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Service;
use App\Models\ChildCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newAdmin = [
            'first_name' => 'Efren',
            'last_name' => 'Goron',
            'user_name' => 'egoronweb',
            'email' => 'egoronweb@gmail.com',
            'password' => Hash::make('Admin@BookEase'),
            'role' => 'Admin',
            'gender' => 'male',
            'address' => 'Lapu-lapu Atabay',
            'city' => 'Hilongos',
            'province' => 'Leyte',
            'country' => 'Philippines',
            'postal_code' => '6524',
            'phone_number' => '+639054170203',
        ];

        $user = User::where('email', $newAdmin['email'])->first();

        if (!$user) {
            $newUser = User::create([
                'first_name' => $newAdmin['first_name'],
                'last_name' => $newAdmin['last_name'],
                'user_name' => $newAdmin['user_name'],
                'email' => $newAdmin['email'],
                'password' => $newAdmin['password'],
                'role' => $newAdmin['role'],
                'user_type' => 'i',
                'email_verified_at' => now(),
            ]);

            Profile::create([
                'user_id' => $newUser->id,
                'gender' => $newAdmin['gender'],
                'address' => $newAdmin['address'],
                'city' => $newAdmin['city'],
                'province' => $newAdmin['province'],
                'country' => $newAdmin['country'],
                'postal_code' => $newAdmin['postal_code'],
                'phone_number' => $newAdmin['phone_number'],
            ]);
        }
    }
}
