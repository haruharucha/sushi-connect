<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FishSeeder extends Seeder
{
    public function run()
    {
        DB::table('fishes')->insert([
            ['id' => 1, 'name' => 'アジ', 'created_at' => '2026-06-12 14:39:05', 'updated_at' => '2026-06-12 14:39:05'],
            ['id' => 2, 'name' => 'イサキ', 'created_at' => '2026-06-12 14:39:05', 'updated_at' => '2026-06-12 14:39:05'],
            ['id' => 3, 'name' => 'カツオ', 'created_at' => '2026-06-12 14:39:05', 'updated_at' => '2026-06-12 14:39:05'],
            ['id' => 4, 'name' => 'サンマ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 5, 'name' => 'ブリ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 6, 'name' => 'サワラ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 7, 'name' => 'マダイ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 8, 'name' => 'ヒラメ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 9, 'name' => 'キンメダイ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 10, 'name' => 'サバ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 11, 'name' => 'シマアジ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 12, 'name' => 'ハマチ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 13, 'name' => 'タチウオ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 14, 'name' => 'ホタテ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
            ['id' => 15, 'name' => 'イワシ', 'created_at' => '2026-06-19 23:18:33', 'updated_at' => '2026-06-19 23:18:33'],
        ]);
    }
}