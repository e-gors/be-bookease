<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get the roles from the database
        $roles = Role::where('name', '!=', 'Admin')->pluck('name')->toArray();
        $status = $this->faker->randomElement(['active', 'in active', 'banned', 'deleted']);
        $userType = $this->faker->randomElement(['I', 'B', 'i', 'b']);
        $banDurations = [
            Carbon::now()->addDay(),
            Carbon::now()->addDays(2),
            Carbon::now()->addWeek()
        ];
        $bannedUntil = $status === 'active' ? null : $this->faker->randomElement($banDurations);

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'user_name' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement($roles),
            'user_type' => $userType,
            'status' => $status,
            'banned_until' => $bannedUntil,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
