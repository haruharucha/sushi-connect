<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    // create() や update() で一括代入を許可するカラム
    protected $fillable = [
        'name',
        'postal_code',
        'area',
        'address',
        'phone_number',
        'image_path',
        'opening_start',
        'opening_end',
        'style',         
        'price_range',   
        'description',  
    ];

    //「1つの店舗には、たくさんの口コミ（複数）がある」ので、hasMany を使う
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
