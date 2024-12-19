<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

// 認証済み管理者
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // ダッシュボード
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // 店舗代表者管理
    Route::prefix('shop-owners')->name('shop_owners.')->group(function () {
        Route::get('/', [AdminController::class, 'listShopOwners'])->name('list');
        Route::get('/create', [AdminController::class, 'createShopOwner'])->name('create');
        Route::post('/', [AdminController::class, 'storeShopOwner'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editShopOwner'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'updateShopOwner'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroyShopOwner'])->name('destroy');
        Route::get('/{id}/stores', [AdminController::class, 'viewStores'])->name('stores');
    });

    Route::get('/shop/{shop_id}/detail', [AdminController::class, 'detail'])->name('shop.detail');
    Route::delete('/stores/{id}', [AdminController::class, 'destroyStore'])->name('stores.destroy');

    // メール送信
    Route::get('send-email', [AdminController::class, 'sendEmailPage'])->name('send_email');
    Route::post('send-email', [AdminController::class, 'sendEmail'])->name('send_email.send');

});
