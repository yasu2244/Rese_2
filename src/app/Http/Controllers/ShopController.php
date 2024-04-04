<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function detail($id)
    {
        Session::put('previousUrl', url()->previous());
        
        $restaurant = Restaurant::findOrFail($id);
        return view('detail', ['restaurant' => $restaurant]);
    }

}
