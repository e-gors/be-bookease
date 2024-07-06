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
        $barangays = [
            'Poblacion',
            'San Juan',
            'Santa Cruz',
            'San Isidro',
        ];

        return [
            'street' => $this->faker->streetAddress,
            'barangay' => $this->faker->randomElement($barangays),
            'locality' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
            'phone_number' => $this->faker->phoneNumber,
            'profile_picture' => null,
        ];
    }
}
