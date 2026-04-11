<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // pluck id of users with role branch manager
        $branchManagerIds = User::where('role', User::ROLE_BRANCH_MANAGER)->pluck('id')->toArray();
        //
        Branch::factory(2)->create([
            'manager_id' => fake()->randomElement($branchManagerIds),

        ]);
    }
}
