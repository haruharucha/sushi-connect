<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            //constrained()はshop_id は shops テーブルの id を、user_id は users テーブルの id を参照する外部キーとして認識
            //onDelete('cascade'):もし店舗やユーザーが削除された場合、連動してその口コミも自動削除される
            // 外部キー：どの店舗への口コミか
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            // 外部キー：誰が書いた口コミか
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // 口コミの内容
            $table->integer('rating'); // 星の数（1〜5など）
            $table->text('comment');   // コメント本文
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
