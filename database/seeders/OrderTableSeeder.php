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
        // store manager user
        $storemanagers = User::where('role', User::ROLE_STORE_MANAGER)->get();
        foreach ($storemanagers as $storemanager) {

            Order::factory(10)->create([
                'store_id' => $storemanager->store_id,
                'ordered_by' => $storemanager->id,
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
