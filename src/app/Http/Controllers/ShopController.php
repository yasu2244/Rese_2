<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function detail($shop_id)
    {
        return view('shop.detail', ['shop_id' => $shop_id]);
    }
}
