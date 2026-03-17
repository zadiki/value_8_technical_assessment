<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 random users using the UserFactory
        User::factory(7)->create([
            'password' => '12345678',
        ]);
        User::factory(1)->create([
            'password' => '12345678',
            'role' => User::ROLE_ADMINISTRATOR,
            'email' => 'zadiki@admin.com',

        ]);
        User::factory(1)->create([
            'password' => '12345678',
            'role' => User::ROLE_BRANCH_MANAGER,
            'email' => 'zadiki@branch.com',

        ]);
        User::factory(1)->create([
            'password' => '12345678',
            'role' => User::ROLE_STORE_MANAGER,
            'email' => 'zadiki@store.com',

        ]);
    }
}
