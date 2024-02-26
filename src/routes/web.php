<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');

Route::get('/register', [AuthController::class,'getRegister'])->name('register');
Route::post('/register', [AuthController::class,'postRegister']);

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin']);

Route::get('/mypage', [UserController::class, 'index'])->name('mypage');

Route::post('/reservation/confirm', [ReservationController::class, 'confirmReservation'])->name('reservation.confirm');
Route::get('/reservation/done', [ReservationController::class, 'showDonePage'])->name('reservation.done');