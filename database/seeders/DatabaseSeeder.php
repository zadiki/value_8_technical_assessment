<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserTableSeeder::class,
            ProductTableSeeder::class,
            BranchTableSeeder::class,
            StoreTableSeeder::class,
            InventoryTableSeeder::class,
            SaleTableSeeder::class,
            SaleDetailTableSeeder::class,
            OrderTableSeeder::class,
            OrderDetailTableSeeder::class,
            DeliveryNoteTableSeeder::class,
        ]);
    }
}
