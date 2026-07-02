<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            
            // 外部キー（お店のIDとユーザーのIDを紐づける）
            // ※店テーブルやユーザーテーブルとカスケード削除で連動させます
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // ユーザーが入力して保存するデータ
            $table->datetime('reserved_at');      // 予約日時（日付と時間）
            $table->integer('number_of_people'); // 予約人数
            
            $table->timestamps(); // 作成日時・更新日時（Laravelが自動で使う箱）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}