@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review/all-post.css') }}">
@endsection

@section('main')
<div class="main">

    <div class="reviews-section">
        <h2>この店舗に関する全ての口コミ</h2>
        @forelse ($reviews as $review)
        <div class="review-item">
            <div class="review-header">
                <p class="review-author">
                    <strong>{{ $review->user ? $review->user->name : 'レビュー者不明' }}</strong>
                    <span class="review-date"> - {{ $review->created_at->format('Y-m-d') }}</span>
                </p>
            </div>

            <div class="review-rating">
                <p class="rating-stars">{{ str_repeat('★', $review->rating) }}</p>
            </div>

            <div class="review-comment">
                <p class="comment-text">{{ $review->comment }}</p>
            </div>

            @if (!is_null($review->image_url))
                <div class="review-image">
                    <img src="{{ $review->image_url }}" alt="Review Image" width="200">
                </div>
            @endif
        </div>
        @empty
            <p>まだ口コミがありません。</p>
        @endforelse
    </div>
</div>
@endsection
