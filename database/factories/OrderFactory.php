<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
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
            //
            'lpo_number' => fake()->unique()->numerify('LPO-#####'),
            'order_type' => fake()->randomElement([Order::ORDER_TYPE_SHOP_ORDER, Order::ORDER_TYPE_BRANCH_ORDER, Order::ORDER_TYPE_CENTRAL_WAREHOUSE_ORDER]),
            'store_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'branch_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'status' => fake()->randomElement([Order::STATUS_CREATED, Order::STATUS_CONFIRMED, Order::STATUS_CANCELLED, Order::STATUS_DISPATCHED, Order::STATUS_DELIVERED]),
            'ordered_by' => fake()->randomElement([1, 2, 3, 4, 5]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
