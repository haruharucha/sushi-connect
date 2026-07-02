<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MypageController;


// 🍣 トップページ（店舗一覧・検索結果表示）
Route::get('/', [ShopController::class, 'index'])->name('home');

// 🍣 店舗詳細画面（{id} にお店のIDが入る）
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');

// 🔒 ログイン必須のルート（一般ユーザー向け）
Route::middleware('auth')->group(function () {
    
    // 📅 予約処理
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
    // 📅 予約完了画面
    Route::get('/reservations/done', function () {
        return view('reservations.done');
    })->name('reservations.done');

    // ❌ 予約キャンセル処理
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // 👤 マイページ（予約履歴など）
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');

    // Breezeのデフォルトダッシュボード
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // 💬 口コミ投稿の保存処理
    Route::post('/shops/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // 💬 口コミ編集画面
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');

    // 💬 口コミ更新処理
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    // 💬 口コミ削除処理
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// 管理者専用ルート
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 📊 管理者ダッシュボード画面 (/admin/dashboard)
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // 📝 店舗の新規登録画面表示 (/admin/shops/create) 
        Route::get('/shops/create', [AdminController::class, 'create'])->name('shops.create');

        // 💾 店舗の新規保存処理 (/admin/shops)
        Route::post('/shops', [AdminController::class, 'store'])->name('shops.store');

        // 📐 店舗の編集画面表示 (/admin/shops/{id}/edit)
        Route::get('/shops/{id}/edit', [AdminController::class, 'edit'])->name('shops.edit');
        
        // 🆙 編集データの更新処理 (/admin/shops/{id})
        Route::patch('/shops/{id}', [AdminController::class, 'update'])->name('shops.update');

        // 🗑️ 店舗の削除処理 (/admin/shops/{id})
        Route::delete('/shops/{id}', [AdminController::class, 'destroy'])->name('shops.destroy');

        // 🗑️ 口コミの削除処理 (/admin/reviews/{review})
        Route::delete('/reviews/{review}', [AdminController::class, 'destroyReview'])->name('reviews.destroy');

    });

require __DIR__.'/auth.php';