<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->query('order');

        $query = Shop::query();

        if ($order === 'random') {
            $query->inRandomOrder();
        } elseif ($order === 'high_rating') {
            $query->withSum('reviews as total_rating', 'rating')
                ->orderByRaw('total_rating = 0, total_rating desc');
        } elseif ($order === 'low_rating') {
            $query->withSum('reviews as total_rating', 'rating')
                ->orderByRaw('total_rating = 0, total_rating asc');
        }

        $shops = $query->with('likes')->get();

        // ログイン中のユーザーの「いいね」を取得
        $userLikes = [];
        if (auth()->check()) {
            $userLikes = auth()->user()->likes()->pluck('shop_id')->toArray();
        }

        return view('index', compact('shops', 'userLikes'));
    }

    public function search(Request $request)
    {
        $area_name = $request['area'];
        $genre_name = $request['genre'];
        $keyword = $request['keyword'];

        $searchResult = Shop::searchShops($area_name, $genre_name, $keyword);
        $shops = $searchResult['shops'];
        $text = "「" . $searchResult['text'] . "」の検索結果";

        session()->flash('fs_msg', $text);
        return view('index', compact("shops", "text"));
    }

    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre')->findOrFail($shop_id);
        $reviews = Review::where('shop_id', $shop_id)->with('user')->get();
        $userReview = null;

        if (auth()->check()) {
            // ログインユーザーの口コミを取得（存在する場合）
            $userReview = Review::where('shop_id', $shop_id)
                                ->where('user_id', auth()->id())
                                ->first();
        }

        $today = Carbon::now()->toDateString();

        return view('detail', compact('shop', 'reviews', 'userReview', 'today'));
    }

}
