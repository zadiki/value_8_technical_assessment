<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $shopIds = Shop::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        Sale::factory(100)->create([
            'shop_id' => fake()->randomElement($shopIds),
            'sold_by' => fake()->randomElement($userIds),
        ]);
    }
}
