<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $averageRatings = Review::select('restaurant_id', DB::raw('AVG(rating) as average_rating'))
        ->groupBy('restaurant_id')
        ->get();


        return view('index', compact('averageRatings'));
    }

    public function detail($id)
    {
        Session::put('previousUrl', url()->previous());
        
        $restaurant = Restaurant::findOrFail($id);
        return view('detail', ['restaurant' => $restaurant]);
    }

}
