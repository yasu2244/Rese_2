<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckReservationDone;


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class,'getLogout'])->name('logout');

    Route::post('/favorite/add', [FavoriteController::class, 'addFavorite'])->name('favorite.add');

    Route::post('/favorite/remove', [FavoriteController::class, 'removeFavorite'])->name('favorite.remove');

    Route::get('/user/favorites', [FavoriteController::class, 'getFavorites']);

    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::delete('/delete-reservation', [UserController::class, 'deleteReservation']);

    Route::post('/reservation/confirm', [ReservationController::class, 'confirmReservation'])->name('reservation.confirm');
    Route::get('/reservation/{reservation_id}/change', [ReservationController::class, 'showChangeForm'])->name('reservation.change');
    Route::post('/reservation/change/{reservation_id}', [ReservationController::class, 'changeReservation'])->name('reservation.change.submit');
    Route::get('reservation/done', [ReservationController::class, 'showDonePage'])->name('reservation.done')->middleware(CheckReservationDone::class);

    Route::get('/review/posts', [ReviewController::class, 'index'])->name('review.posts');
    Route::get('/review/{restaurant_id}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::post('/review/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');

Route::get('/register', [AuthController::class,'getRegister'])->name('register');
Route::post('/register', [AuthController::class,'postRegister']);

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/index', function () {
    return view('index');
});

