<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\ShopController;
use App\Http\Controllers\Owner\ReservationController;

// 認証済み店舗代表者
Route::middleware(['auth', 'role:shop_owner'])->prefix('owner')->name('owner.')->group(function () {
    // ダッシュボード
    Route::get('dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');

    // 店舗関連
    Route::prefix('shops')->name('shops.')->group(function () {
        Route::get('create', [ShopController::class, 'create'])->name('create'); // 店舗作成ページ
        Route::post('create', [ShopController::class, 'store'])->name('store'); // 店舗作成処理
        Route::get('update', [ShopController::class, 'edit'])->name('update'); // 店舗更新ページ
        Route::put('update/{id}', [ShopController::class, 'update'])->name('update.process'); // 店舗更新処理
    });

    // 予約関連
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index'); // 予約状況確認
});
