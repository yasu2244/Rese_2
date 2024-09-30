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
        // クエリパラメータから並び替えオプションを取得
        $order = $request->query('order');

        // クエリビルダーを使用して並び替え条件を適用
        $query = Shop::query();

        if ($order === 'random') {
            // ランダム並び替え
            $query->inRandomOrder();
        } elseif ($order === 'high_rating') {
            // 各ユーザーの評価の合計を計算し、評価が高い順に並び替え、評価がない店舗を最後に
            $query->withSum('reviews as total_rating', 'rating') // 各店舗の評価の合計を取得
                ->orderByRaw('total_rating = 0, total_rating desc'); // 評価の合計が0の店舗は最後
        } elseif ($order === 'low_rating') {
            // 各ユーザーの評価の合計を計算し、評価が低い順に並び替え、評価がない店舗を最後に
            $query->withSum('reviews as total_rating', 'rating') // 各店舗の評価の合計を取得
                ->orderByRaw('total_rating = 0, total_rating asc'); // 評価の合計が0の店舗は最後
        }

        // クエリの実行
        $shops = $query->get();

        // セッションフラッシュメッセージのクリア
        session()->flash('fs_msg', null);

        // ビューにデータを渡す
        return view('index', compact('shops'));
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
