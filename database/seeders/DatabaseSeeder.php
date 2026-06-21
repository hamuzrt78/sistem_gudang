<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(PengajuansTableSeeder::class);
        $this->call(StockInsTableSeeder::class);
        $this->call(StockOutsTableSeeder::class);
        $this->call(StockMutationsTableSeeder::class);
    }
}
