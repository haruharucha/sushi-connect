<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ShopSeeder::class,
            FishSeeder::class,
            MonthSeeder::class,
            FishMonthSeeder::class,
        ]);
}}
