<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

use Illuminate\Support\Facades\Log;  //あとで消す

class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {

        $user = auth()->user();
        $restaurantId = $request->input('restaurant_id');
        Log::info('addFavorite メソッドが呼び出されました。');  //後で消す
        
        $favorite = new Favorite();
        $favorite->user_id = $user->id;
        $favorite->restaurant_id = $restaurantId;
        $favorite->save();
        
        $isFavorite = $user->favorites()->where('restaurant_id', $restaurantId)->exists();
    
        return response()->json(['success' => true, 'is_favorite' => $isFavorite]);
    }

    public function removeFavorite(Request $request)
    {
        $user = auth()->user();
        $restaurantId = $request->input('restaurant_id');
        Log::info('removeFavorite メソッドが呼び出されました。'); //後で消す
        
        Favorite::where('user_id', $user->id)
            ->where('restaurant_id', $restaurantId)
            ->delete();
        
        $isFavorite = $user->favorites()->where('restaurant_id', $restaurantId)->exists();

        return response()->json(['success' => true, 'is_favorite' => $isFavorite]);
    }

    public function getFavorites() {
        if (auth()->check()) {
            $user = auth()->user();
            $favorites = Favorite::where('user_id', $user->id)->pluck('restaurant_id')->toArray();
            return response()->json(['favorites' => $favorites]);
        } else {
             return redirect()->route('login');
        }
    }
}
