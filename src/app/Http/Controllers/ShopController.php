<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query();

        if ($request->filled('area')) {
            $query->where('region', $request->area);
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $restaurants = $query->get();

        $areas = Restaurant::select('region')->distinct()->pluck('region');

        $genres = Restaurant::select('genre')->distinct()->pluck('genre');

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
