<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->words(3, true),
            'product_type' => fake()->randomElement(['Electronics', 'Books', 'Clothing', 'Groceries', 'Home Goods']),
            'product_code' => fake()->unique()->ean8(),
            'bar_code' => fake()->unique()->ean13(),
            'market_unit_cost' => fake()->randomFloat(2, 5, 500),
            'brand' => fake()->company(),
            'manufacturer' => fake()->company(),
        ];
    }
}