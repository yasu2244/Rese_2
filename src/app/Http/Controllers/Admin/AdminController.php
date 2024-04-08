<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class AdminController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        // $Managers = Manager::all();

        return view('admin.shop-list', ['restaurants' => $restaurants]);
    }
}