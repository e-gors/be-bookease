<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        return [
            'gender' => $this->faker->randomElement(['male', 'female', 'prefer not to say']),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'province' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
            'phone_number' => $this->faker->phoneNumber,
            'profile_picture' => $this->faker->imageUrl,
        ];
    }
}
