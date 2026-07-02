<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('months')->insert([
            [
                'id' => 1,
                'number' => 6,
                'created_at' => '2026-06-12 14:39:05',
                'updated_at' => '2026-06-12 14:39:05',
            ],
            [
                'id' => 2,
                'number' => 1,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 3,
                'number' => 2,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 4,
                'number' => 3,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 5,
                'number' => 4,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 6,
                'number' => 5,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 7,
                'number' => 7,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 8,
                'number' => 8,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 9,
                'number' => 9,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 10,
                'number' => 10,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 11,
                'number' => 11,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
            [
                'id' => 12,
                'number' => 12,
                'created_at' => '2026-06-19 23:15:33',
                'updated_at' => '2026-06-19 23:15:33',
            ],
        ]);
    }
}