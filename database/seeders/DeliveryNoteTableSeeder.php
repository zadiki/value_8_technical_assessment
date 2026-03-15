<?php

namespace Database\Seeders;

use App\Models\DeliveryNote;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DeliveryNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orders = Order::all();
        foreach ($orders as $order) {
            if ($order->store_id) {
                DeliveryNote::factory(1)->create([
                    'store_id' => $order->store_id,
                ]);
            } else {
                DeliveryNote::factory(1)->create([
                    'branch_id' => $order->branch_id,
                ]);
            }

        }
    }
}
