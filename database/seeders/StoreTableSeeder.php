<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $branchIds = Branch::pluck('id')->toArray();
        Store::factory(3)->create([
            'branch_id' => fake()->randomElement($branchIds),
        ]);
    }
}
