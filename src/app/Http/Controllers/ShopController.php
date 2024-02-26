<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index()
    {
        // エリアの一覧を取得
        $areas = Restaurant::select('region')->distinct()->pluck('region');

        // ジャンルの一覧を取得
        $genres = Restaurant::select('genre')->distinct()->pluck('genre');

        $restaurants = Restaurant::all();
        return view('index', [
            'restaurants' => $restaurants,
            'areas' => $areas,
            'genres' => $genres,
        ]);
    }


    public function detail($id)
    {
        Session::put('previousUrl', url()->previous());

        $restaurant = Restaurant::findOrFail($id);
        return view('detail', ['restaurant' => $restaurant]);
    }

}
