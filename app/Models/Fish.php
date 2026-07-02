<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fish extends Model
{
    use HasFactory;

    protected $table = 'fishes';
    
    // すべてのカラムの一括代入を許可
    protected $guarded = [];


    // この魚が旬の月を取得
    public function months(): BelongsToMany
    {
        return $this->belongsToMany(Month::class);
    }
}