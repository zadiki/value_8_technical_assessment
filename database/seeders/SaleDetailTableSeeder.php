<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Seeder;

class SaleDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $saleIds = Sale::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();
        SaleDetail::factory(200)->create([
            'sale_id' => fake()->randomElement($saleIds),
            'product_id' => fake()->randomElement($productIds),
        ]);
        //
    }
}
