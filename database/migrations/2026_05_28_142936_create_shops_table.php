<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // shops テーブルにカラムを定義、データ型指定
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // 店名、string（文字列）型
            $table->string('postal_code');   //郵便番号
            $table->string('area')->nullable();          // エリア（東京都 など）、string（文字列）型
            $table->string('style')->nullable();         // ジャンル（高級・おまかせ など）、string（文字列）型
            $table->string('price_range')->nullable();    // 価格帯、string（文字列）型
            $table->text('description')->nullable();     // 説明文、text 型
            $table->string('address');       // 住所、string（文字列）型
            $table->string('phone_number');         // 電話番号、string（文字列）型
            $table->time('opening_start')->nullable();   // 開店時間、time 型
            $table->time('opening_end')->nullable();     // 閉店時間、time 型
            $table->string('image_url')->nullable(); // 画像URL（空での保存を許可）
            $table->timestamps();            // created_at と updated_at、datetime（日時）型
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};