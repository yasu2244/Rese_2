<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class,'getLogout'])->name('logout');

    Route::post('/favorite/add', [FavoriteController::class, 'addFavorite'])->name('favorite.add');

    Route::post('/favorite/remove', [FavoriteController::class, 'removeFavorite'])->name('favorite.remove');

    Route::get('/user/favorites', [FavoriteController::class, 'getFavorites']);

    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::delete('/delete-reservation', [UserController::class, 'deleteReservation']);

    Route::post('/reservation/confirm', [ReservationController::class, 'confirmReservation'])->name('reservation.confirm');
    Route::get('/reservation/done', [ReservationController::class, 'showDonePage'])->name('reservation.done');
});

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');

Route::get('/register', [AuthController::class,'getRegister'])->name('register');
Route::post('/register', [AuthController::class,'postRegister']);

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);

