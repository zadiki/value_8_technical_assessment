<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productIds = Product::pluck('id')->toArray();
        $storeIds = Store::pluck('id')->toArray();
        $branchIds = Branch::pluck('id')->toArray();
        Inventory::factory(100)->create([
            'product_id' => fake()->randomElement($productIds),
            'store_id' => fake()->randomElement($storeIds),
            'branch_id' => fake()->randomElement($branchIds),
        ]);

    }
}
