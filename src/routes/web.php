<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ShopController;

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

Route::group(['middleware' => ['admin']], function () {
    Route::post('admin/store', [ShopController::class, 'store'])->name('admin.store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';