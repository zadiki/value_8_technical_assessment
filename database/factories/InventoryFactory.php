<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'product_id' => fake()->unique(),
            'cost_price' => fake()->randomFloat(2, 1, 100),
            'selling_price' => fake()->randomFloat(2, 1, 150),
            'store_id' => null,
            'branch_id' => null,
            'quantity' => fake()->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
