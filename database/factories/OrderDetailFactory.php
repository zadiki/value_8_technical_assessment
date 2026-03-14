<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1, 10),
            'order_id' => fake()->numberBetween(1, 5),
            'ordered_quantity' => fake()->numberBetween(1, 10),
            'unit_cost' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
