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
                ->withCount('reviews')
                ->orderByRaw('COALESCE(total_rating, 0) DESC, reviews_count DESC');
        } elseif ($order === 'low_rating') {
            $query->withSum('reviews as total_rating', 'rating')
                ->withCount('reviews')
                ->orderByRaw('COALESCE(total_rating, 0) ASC, reviews_count ASC');
        }
    
        // 店舗情報を取得（エリア、ジャンル、いいね情報を含む）
        $shops = $query->with('area', 'genre', 'likes')->get();
    
        // ログイン中のユーザーの「いいね」を取得
        $userLikes = auth()->check() ? auth()->user()->likes->pluck('id')->toArray() : [];
    
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

        $userLikes = auth()->check() ? auth()->user()->likes()->pluck('shop_id')->toArray() : [];

        session()->flash('fs_msg', $text);
        return view('index', compact("shops", "text", "userLikes"));
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

        // 固定の時間スロットを生成
        $timeSlots = [
            '10:00', '10:30', '11:00', '11:30', '12:00',
            '12:30', '13:00', '13:30', '14:00', '14:30',
            '17:00', '17:30', '18:00', '18:30', '19:00',
            '19:30', '20:00', '20:30', '21:00', '21:30', '22:00',
        ];

        return view('detail', compact('shop', 'reviews', 'userReview', 'today', 'timeSlots'));
    }

}
