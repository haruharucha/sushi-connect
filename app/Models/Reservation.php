<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム
    protected $fillable = [
        'shop_id',
        'user_id',
        'reserved_at',
        'number_of_people',
    ];

    // 一つの予約は一つの店舗に属する
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

}