<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Branch;


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
