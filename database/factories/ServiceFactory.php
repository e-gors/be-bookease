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
        $pricingModel = $this->faker->randomElement(['per_service', 'per_hour', 'per_day']);

        $price = match ($pricingModel) {
            'per_service' => $this->faker->randomFloat(2, 500, 5000),
            'per_hour' => $this->faker->randomFloat(2, 50, 500),
            'per_day' => $this->faker->randomFloat(2, 100, 3000),
        };

        // Define available time slots with structured data
        $availableTimes = $this->faker->randomElement([
            [
                'type' => "Normal Day",
                'morning' => ['start' => '7 AM', 'end' => '12 PM'],
                'afternoon' => ['start' => '1 PM', 'end' => '5 PM']
            ],
            [
                'type' => 'Full Day',
                'start' => '7 AM',
                'end' => '5 PM'
            ],
        ]);

        return [
            'child_category_id' => $category->id,
            'pricing_model' => $pricingModel,
            'price' => $price,
            'location' => $this->faker->address,
            'available_times' => json_encode($availableTimes), // Store as JSON
        ];
    }
}
