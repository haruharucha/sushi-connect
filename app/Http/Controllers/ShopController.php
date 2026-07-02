<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop; 
use App\Models\Fish;
use Carbon\Carbon;

class ShopController extends Controller
{
    /**
     * トップページと検索結果を表示する
     */
    public function index(Request $request) 
    {
         // 店舗検索用のクエリを作成
        $query = Shop::query();

        // エリアが選択されている場合は絞り込む
        if ($request->filled('area')) {
            $query->where('area', $request->area);
        }

        // キーワードが入力されている場合は、店名・紹介文・住所・スタイルから検索する
        if ($request->filled('keyword')) {
            $word = '%' . $request->keyword . '%';

            $query->where(function($q) use ($word) {
                $q->where('name', 'like', $word)
                  ->orWhere('description', 'like', $word)
                  ->orWhere('address', 'like', $word)
                  ->orWhere('style', 'like', $word);
            });
        }

        // 検索条件に合う店舗を取得
        $shops = $query->get();

        //旬魚検索機能
        // 現在の月を取得
        $currentMonth = Carbon::now()->month;

        // 現在の月に紐づく旬の魚を取得
        $seasonalFishes = Fish::whereHas('months', function ($query) use ($currentMonth) {
            $query->where('number', $currentMonth);
        })->get();

        return view('welcome', compact('shops', 'seasonalFishes', 'currentMonth'));
    }

    /**
     * 店舗詳細画面を表示する
     */
    public function show($id)
    {
        // 指定された店舗を取得
        $shop = Shop::findOrFail($id);

        return view('shops.show', compact('shop'));
    }
}