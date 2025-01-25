<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Order " .fake()->unique()->sentence(2),
            'description' => "Order description " .fake()->sentence(7),
            //'date' => fake()->dateTimeThisYear(),
            'date' => fake()->dateTimeBetween('2025-01-01', '2025-03-31'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
