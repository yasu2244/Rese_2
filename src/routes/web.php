<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ShopOwnerController;

Route::get('/', [ShopsController::class, 'index'])->name('root');
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');
Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('shop/{shop_id}/reviews', [ReviewController::class, 'allReviews'])->name('review.all');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UsersController::class, 'mypage'])->name('mypage');

    Route::post('/like/{shop_id}', [FavoriteController::class, 'create'])->name('like');
    Route::post('/unlike/{shop_id}', [FavoriteController::class, 'delete'])->name('unlike');

    Route::post('/reservation', [ReservationsController::class, 'create'])->name('reserve.create');
    Route::delete('/reserve/{reservation_id}', [ReservationsController::class, 'delete'])->name('reserve.delete');

    Route::get('/review/posts', [ReviewController::class, 'index'])->name('review.posts');
    Route::get('/review/{shop_id}/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::delete('review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update'); 

});

Route::middleware(['guest'])->group(function () {
    // 管理者ログインフォームの表示
    Route::get('admin/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    // 管理者ログインの処理
    Route::post('admin/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login.submit');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // 管理者ダッシュボード
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/stores/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroyStore'])->name('stores.destroy');

    // 店舗代表者関連
    Route::prefix('shop-owners')->name('shop_owners.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'listShopOwners'])->name('list');
        Route::get('/create', [App\Http\Controllers\Admin\AdminController::class, 'createShopOwner'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\AdminController::class, 'storeShopOwner'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\AdminController::class, 'editShopOwner'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateShopOwner'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroyShopOwner'])->name('destroy');
        Route::get('/{id}/stores', [App\Http\Controllers\Admin\AdminController::class, 'viewStores'])->name('stores');         // 担当店舗リスト
    });

    // お知らせメール送信
    Route::get('send-email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailPage'])->name('send_email');
    Route::post('send-email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmail'])->name('send_email.send');

    // ログアウト
    Route::post('logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');
});

Route::get('/detail/{shop_id}', [AdminController::class, 'detail'])->name('admin.shop.detail');

Route::middleware(['auth', 'role:shop_owner'])->group(function () {
    Route::get('shop/dashboard', [App\Http\Controllers\Admin\ShopOwnerController::class, 'dashboard'])->name('shop.dashboard');
    Route::get('shop/reservations', [App\Http\Controllers\Admin\ShopOwnerController::class, 'viewReservations']);
});



require __DIR__ . '/auth.php';
