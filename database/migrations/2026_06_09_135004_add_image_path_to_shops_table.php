<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            //  shopsテーブルの phone_number の後ろに、空っぽでもOK（nullable）な image_path 列を追加
            $table->string('image_path')->nullable()->after('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            // もし元に戻す（ロールバック）ときは、image_path 列を消す
            $table->dropColumn('image_path');
        });
    }
};