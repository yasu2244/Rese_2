<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

class OwnerController extends Controller
{
    // ダッシュボード表示
    public function dashboard()
    {
        return view('owner.owner-dashboard');
    }
}
