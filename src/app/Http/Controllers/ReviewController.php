<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('user_id', auth()->id())->get();

        return view('review.personal-list', compact('reviews'));
    }

    public function create($shop_id)
    {
        $shop = shop::findOrFail($shop_id);
        return view('review.post', compact('shop'));
    }

    public function store(ReviewRequest $request)
    {
        $shop = Shop::findOrFail($request->shop_id);

        $review = new Review();
        $review->user_id = auth()->id();
        $review->shop_id = $shop->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;

        // 画像の保存処理
        if ($request->hasFile('image')) {
            // 画像を1枚保存
            $path = $request->file('image')->store('reviews', 'public');
            $review->image_path = $path;  // 画像のパスを文字列として保存
        }

        $review->save();

        return redirect()->route('root')->with('success', '投稿ありがとうございます。');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $shop = $review->shop;
        return view('review.edit', compact('review', 'shop'));
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);

        // 既存の画像の削除と新しい画像のアップロード処理
        if ($request->hasFile('image')) {
            // 古い画像を削除
            if ($review->image_path) {
                Storage::disk('public')->delete($review->image_path);
            }

            // 新しい画像を保存
            $imagePath = $request->file('image')->store('reviews', 'public');
            $review->image_path = $imagePath;
        }

        // レビューの更新
        $review->update([
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'image_path' => $review->image_path, // 画像パスを更新
        ]);

        return redirect()->route('review.posts')->with('success', 'レビューが更新されました。');
    }

    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);

            // 画像が存在する場合、サーバーから削除
            if ($review->image_path) {
                try {
                    Storage::disk('public')->delete($review->image_path);
                } catch (Exception $e) {
                    // 画像削除に失敗した場合のログ
                    Log::error('画像の削除に失敗しました: ' . $review->image_path);
                }
            }

            // レビューの削除
            $review->delete();
            
            return redirect()->route('review.posts')->with('success', 'レビューが削除されました。');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('review.posts')->with('error', 'レビューが見つかりませんでした。');
        }
    }

    public function allReviews($shop_id)
    {
        $shop = Shop::with('area', 'genre')->findOrFail($shop_id);
        $reviews = Review::where('shop_id', $shop_id)->with('user')->get();

        // 各口コミの画像URLを生成
        foreach ($reviews as $review) {
            if ($review->image_path) {
                $review->image_url = Storage::url($review->image_path);  // 画像パスをそのままURLに変換
            } else {
                $review->image_url = null;  // 画像がない場合はnull
            }
        }

        return view('review.all-post', compact('shop', 'reviews'));
    }

}