<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Service;
use App\Models\ChildCategory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create()->each(function ($user) {
            $user->profile()->save(Profile::factory()->make());

            if ($user->role === 'Service Provider') {
                $user->services()->saveMany(Service::factory(5)->make([
                    'child_category_id' => function () {
                        return ChildCategory::all()->random()->id;
                    },
                ]));
            }
        });
    }
}
