<?php

namespace Database\Factories;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = ChildCategory::all()->random();

    return [
        'child_category_id' => $category->id,
        'pricing_model' => $this->faker->randomElement(['per_service', 'per_hour', 'per_day']),
        'price' => $this->faker->randomFloat(2, 50, 500),
    ];
    }
}
