<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;

Auth::routes(['verify' => true]); // メール認証を有効化

// 一般ユーザー向けルート
Route::get('/', [ShopsController::class, 'index'])->name('root');
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');
Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');

Route::get('shop/{shop_id}/reviews', [ReviewController::class, 'allReviews'])->name('review.all');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UsersController::class, 'mypage'])->name('mypage');

    // お気に入り関連
    Route::post('/like/{shop_id}', [FavoriteController::class, 'create'])->name('like');
    Route::post('/unlike/{shop_id}', [FavoriteController::class, 'delete'])->name('unlike');

    // 予約関連
    Route::post('/reservation/completion', [ReservationsController::class, 'create'])->name('reserve.create');
    Route::get('/reserve/{reservation_id}/edit', [ReservationsController::class, 'edit'])->name('reserve.edit');
    Route::put('/reserve/{reservation_id}', [ReservationsController::class, 'update'])->name('reserve.update');
    Route::delete('/reserve/{reservation_id}', [ReservationsController::class, 'destroy'])->name('reserve.destroy');
    
    //QRコード表示
    Route::get('/qr/{reservation_id}', [ReservationsController::class, 'showQr'])->name('qr.show');

    // 口コミ関連
    Route::get('/review/posts', [ReviewController::class, 'index'])->name('review.posts');
    Route::get('/review/{shop_id}/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

});

// 認証関連
require __DIR__ . '/auth.php';

// 管理者向けルート
require __DIR__ . '/admin.php';

// 店舗代表者向けルート
require __DIR__ . '/owner.php';
