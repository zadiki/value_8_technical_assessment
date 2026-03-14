<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Shop;
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
        $shopIds = Shop::pluck('id')->toArray();
        $branchIds = Branch::pluck('id')->toArray();
        Inventory::factory(100)->create([
            'product_id' => fake()->randomElement($productIds),
            'shop_id' => fake()->randomElement($shopIds),
            'branch_id' => fake()->randomElement($branchIds),
        ]);

    }
}
