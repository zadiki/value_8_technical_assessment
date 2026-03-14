<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;


class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orderIds = Order::pluck('id')->toArray();
        foreach ($orderIds as $orderId) {
            $productIds = Product::pluck('id')->toArray();
            OrderDetail::factory(5)->create([
                'order_id' => $orderId,
                'product_id' => fake()->randomElement($productIds),
            ]);
        }
    }
}
