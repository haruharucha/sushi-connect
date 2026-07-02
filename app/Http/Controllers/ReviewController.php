<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        // 入力値をチェック
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // 必須、整数、1〜5
            'comment' => 'required|string|max:400',     // 必須、文字列、400文字以内
        ]);

        // 口コミを保存
        Review::create([
            'shop_id' => $id,                // URLの{id}どの店舗への口コミか
            'user_id' => Auth::id(),         // 現在ログインしているユーザーのID(users.id)誰が投稿した口コミか
            'rating' => $request->rating,   // フォーム入力、画面から送られてきた星の数
            'comment' => $request->comment, // フォーム入力、画面から送られてきたコメント
        ]);

        // 店舗詳細画面に戻る
        return redirect()->route('shops.show', $id)
                         ->with('success', '口コミを投稿しました！');
    }

    public function edit(Review $review)
    {
        // 投稿者本人以外は編集できないようにする
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        // 口コミ編集画面を表示
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        // 投稿者本人以外は編集できないようにする
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:400',
        ]);

        // 口コミを更新
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('shops.show', $review->shop_id)
                        ->with('success', '口コミを更新しました！');
    }

    public function destroy(Review $review)
    {
        // 投稿者本人以外は削除できないようにする
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        // 削除後に戻る店舗IDを先に取得
        $shopId = $review->shop_id; 

        // 口コミを削除
        $review->delete();

        return redirect()->route('shops.show', $shopId)
                        ->with('success', '口コミを削除しました！');
    }

}