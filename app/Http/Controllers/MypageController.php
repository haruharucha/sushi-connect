<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    /**
     * マイページ（予約履歴一覧）の表示
     */
    public function index()
    {
        // ログイン中のユーザー情報を取得
        $user = Auth::user();

        // 予約履歴を店舗情報と一緒に新しい順で取得
        $reservations = $user->reservations()->with('shop')->orderBy('reserved_at', 'desc')->get();

        // 投稿した口コミを店舗情報と一緒に新しい順で取得
        $reviews = $user->reviews()->with('shop')->latest()->get();

        return view('mypage.index', compact('user', 'reservations', 'reviews'));
    }
}
