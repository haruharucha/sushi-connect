<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FishMonthSeeder extends Seeder
{
    public function run()
    {
        DB::table('fish_month')->insert([
            ['id' => 1, 'fish_id' => 1, 'month_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 2, 'fish_id' => 2, 'month_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 3, 'fish_id' => 3, 'month_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 4, 'fish_id' => 1, 'month_id' => 6, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 5, 'fish_id' => 1, 'month_id' => 7, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 6, 'fish_id' => 2, 'month_id' => 7, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 7, 'fish_id' => 3, 'month_id' => 6, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 8, 'fish_id' => 4, 'month_id' => 9, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 9, 'fish_id' => 4, 'month_id' => 10, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 10, 'fish_id' => 5, 'month_id' => 12, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 11, 'fish_id' => 5, 'month_id' => 2, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 12, 'fish_id' => 5, 'month_id' => 3, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 13, 'fish_id' => 6, 'month_id' => 4, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 14, 'fish_id' => 6, 'month_id' => 5, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 15, 'fish_id' => 6, 'month_id' => 6, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 16, 'fish_id' => 7, 'month_id' => 4, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 17, 'fish_id' => 7, 'month_id' => 5, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 18, 'fish_id' => 7, 'month_id' => 6, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 19, 'fish_id' => 8, 'month_id' => 11, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 20, 'fish_id' => 8, 'month_id' => 12, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 21, 'fish_id' => 8, 'month_id' => 2, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 22, 'fish_id' => 8, 'month_id' => 3, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 23, 'fish_id' => 9, 'month_id' => 12, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 24, 'fish_id' => 9, 'month_id' => 2, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 25, 'fish_id' => 9, 'month_id' => 3, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 26, 'fish_id' => 10, 'month_id' => 10, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 27, 'fish_id' => 10, 'month_id' => 11, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 28, 'fish_id' => 10, 'month_id' => 12, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 29, 'fish_id' => 10, 'month_id' => 2, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 30, 'fish_id' => 10, 'month_id' => 3, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 31, 'fish_id' => 11, 'month_id' => 1, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 32, 'fish_id' => 11, 'month_id' => 7, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 33, 'fish_id' => 11, 'month_id' => 8, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 34, 'fish_id' => 12, 'month_id' => 10, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 35, 'fish_id' => 12, 'month_id' => 11, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 36, 'fish_id' => 12, 'month_id' => 12, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 37, 'fish_id' => 12, 'month_id' => 2, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 38, 'fish_id' => 13, 'month_id' => 7, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 39, 'fish_id' => 13, 'month_id' => 8, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 40, 'fish_id' => 13, 'month_id' => 9, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 41, 'fish_id' => 13, 'month_id' => 10, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 42, 'fish_id' => 14, 'month_id' => 12, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 43, 'fish_id' => 14, 'month_id' => 2, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 44, 'fish_id' => 14, 'month_id' => 3, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 45, 'fish_id' => 14, 'month_id' => 4, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 46, 'fish_id' => 15, 'month_id' => 6, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 47, 'fish_id' => 15, 'month_id' => 1, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 48, 'fish_id' => 15, 'month_id' => 7, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 49, 'fish_id' => 15, 'month_id' => 8, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 50, 'fish_id' => 15, 'month_id' => 9, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
            ['id' => 51, 'fish_id' => 15, 'month_id' => 10, 'created_at' => '2026-06-19 23:25:28', 'updated_at' => '2026-06-19 23:25:28'],
        ]);
    }
}