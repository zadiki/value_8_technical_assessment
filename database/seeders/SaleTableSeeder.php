<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Store;
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

        $storeIds = Store::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        Sale::factory(100)->create([
            'store_id' => fake()->randomElement($storeIds),
            'sold_by' => fake()->randomElement($userIds),
        ]);
    }
}
