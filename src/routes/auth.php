<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\AdminOwnerLoginController;

// ユーザー登録
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// 一般ユーザーのログイン・ログアウト
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// 認証待ち画面
Route::get('/verify-email', [VerificationController::class, 'show'])
    ->middleware('guest')
    ->name('verification.notice');;

// メール認証リンクの処理
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// 認証メール再送信
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['guest', 'throttle:6,1'])
    ->name('verification.send');

// Thanksページ
Route::get('/thanks', function () {
    return view('thanks');
    })->name('thanks');

// 管理者・店舗代表者のログイン・ログアウト
Route::middleware(['guest'])->group(function () {
    Route::get('admin-owner-login', [AdminOwnerLoginController::class, 'showLoginForm'])
        ->name('admin-owner.login.form');

    Route::post('admin-owner-login', [AdminOwnerLoginController::class, 'login'])
        ->name('admin-owner.login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('admin-owner-logout', [AdminOwnerLoginController::class, 'logout'])
        ->name('admin-owner.logout');
});