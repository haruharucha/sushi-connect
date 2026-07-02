<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Month extends Model
{
    use HasFactory;
    
    // すべてのカラムの一括代入を許可
    protected $guarded = [];

    // この月に紐づく旬の魚を取得
    public function fishes(): BelongsToMany
    {
        return $this->belongsToMany(Fish::class);
    }
}