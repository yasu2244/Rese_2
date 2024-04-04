@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('main')
    <h2>レビューの編集</h2>
    <div class="review-form">
        <form action="{{ route('review.update', $review->id) }}" method="POST">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <div class="shop-name">
                <p>店名：<span id="shop-name">{{ $restaurant->name }}</span></p>
            </div>
            <div class="rateing-select">
                <label for="rating">評価:</label>
                <select name="rating" id="rating">
                    <option value="">選択してください</option>
                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>☆☆☆☆☆</option>
                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>☆☆☆☆</option>
                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>☆☆☆</option>
                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>☆☆</option>
                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>☆</option>
                </select>
                <span class="required">※必須</span>
            </div>
            @error('rating')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="comment-area">
                <label for="comment">コメント:</label><br>
                <textarea name="comment" id="comment">{{ $review->comment }}</textarea>
            </div>
            @error('comment')
            <div class="error-message">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="submit">更新する</button>
        </form>
    </div>
@endsection