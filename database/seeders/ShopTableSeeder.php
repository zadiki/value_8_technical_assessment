<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $branchIds = Branch::pluck('id')->toArray();
        Shop::factory(3)->create([
            'branch_id' => fake()->randomElement($branchIds),
        ]);
    }
}
