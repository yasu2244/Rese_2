<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        return view('review.review-posts_list', compact('reviews'));
    }

    public function create($restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        return view('review.review', compact('restaurant'));
    }

    public function store(ReviewRequest $request)
    {
        $restaurant = Restaurant::findOrFail($request->restaurant_id);

        $review = new Review();
        $review->user_id = auth()->id();
        $review->restaurant_id = $restaurant->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect('/detail/'.$request->restaurant_id)->with('success', 'レビューが投稿されました。');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $restaurant = $review->restaurant;
        return view('review.review_edit', compact('review', 'restaurant'));
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);

        $review->update([
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('review.posts')->with('success', 'レビューが更新されました。');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.posts')->with('success', 'レビューが削除されました。');
    }
}

