<?php

namespace Database\Factories;

use App\Models\DeliveryNote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DeliveryNote>
 */
class DeliveryNoteFactory extends Factory
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
            'created_by' => fake()->randomElement([1, 2, 3, 4, 5]),
            'destination_type' => fake()->randomElement([1, 2]),
            'store_id' => null,
            'branch_id' => null,
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
