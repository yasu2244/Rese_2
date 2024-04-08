<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ManagerLoginController;
use App\Http\Controllers\Admin\CreateRestaurantController;
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

//管理者・店舗代表者用
Route::get('/admin/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [RegisterController::class, 'register']);

Route::get('/admin/login', [AdminAuthController::class, 'getLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'postLogin'])->name('admin.login.post');

Route::get('manager/login', [ManagerLoginController::class, 'getLogin'])->name('manager/login');
Route::post('manager/login', [ManagerLoginController::class,'postLogin'])->name('manager.login.post');

//管理者用ページ
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/shop-list', [AdminController::class, 'index'])->name('admin.shop-list');
});

//店舗代表者ページ
// Route::middleware(['manager'])->group(function () {
//     Route::get('', [ManagerLoginController::class, 'index'])->name('');
// });

Route::get('/admin/create-restaurant', [CreateRestaurantController::class, 'showCreateForm'])->name('restaurants.create');

Route::post('/admin/create-restaurant', [CreateRestaurantController::class, 'store'])->name('restaurants.store');