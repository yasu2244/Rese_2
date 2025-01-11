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
}

