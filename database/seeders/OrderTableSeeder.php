<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // shop manager user
        $shopmanagers = User::where('role', User::ROLE_STORE_MANAGER)->get();
        foreach ($shopmanagers as $shopmanager) {

            Order::factory(10)->create([
                'shop_id' => $shopmanager->shop_id,
                'ordered_by' => $shopmanager->id,
            ]);
        }
        $branchmanagers = User::where('role', User::ROLE_BRANCH_MANAGER)->get();
        foreach ($branchmanagers as $branchmanager) {

            Order::factory(10)->create([
                'branch_id' => $branchmanager->branch_id,
                'ordered_by' => $branchmanager->id,
            ]);
        }
    }
}
