<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム
    protected $fillable = [
        'shop_id',
        'user_id',
        'rating',
        'comment',
    ];

    // この口コミを書いたユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // この口コミが投稿された店舗を取得
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
