<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class CreateRestaurantController extends Controller
{
    public function showCreateForm()
    {
        return view('admin.create_restaurant');
    }

    public function store(Request $request)
    {
        // バリデーションは省略（必要に応じて追加）

        $validatedData = $request->validate([
            'name' => 'required|unique:restaurants|max:255',
            'region' => 'required|max:255',
            'genre' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $validatedData['name'];
        $restaurant->region = $validatedData['region'];
        $restaurant->genre = $validatedData['genre'];
        $restaurant->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurant_images', 'public');
            $restaurant->image = $imagePath;
        }

        $restaurant->save();

        return redirect('/')->with('success', '店舗情報が正常に登録されました。');
    }
}
