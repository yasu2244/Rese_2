<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopOwnerController extends Controller
{
    public function dashboard()
    {
        return view('admin.shop_owner_dashboard');
    }

    public function manageShops()
    {
        // 店舗情報の管理ロジック
    }

    public function viewReservations()
    {
        // 予約状況の確認ロジック
    }
}

