@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('main')
<h2>レビューありがとうございます</h2>
    <div class="review-form">
        <form action="{{ route('review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <div class="shop-name">
                <p>店名：<span id="shop-name">{{ $restaurant->name }}</span></p>
            </div>
            <div class="rateing-select">
                <label for="rating">評価:</label>
                <select name="rating" id="rating">
                    <option value="">選択してください</option>
                    <option value="5">☆☆☆☆☆</option>
                    <option value="4">☆☆☆☆</option>
                    <option value="3">☆☆☆</option>
                    <option value="2">☆☆</option>
                    <option value="1">☆</option>
                </select>
                <span class="required">※必須</span>
            </div>
            @error('rating')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="comment-area">
                <label for="comment">コメント:</label><br>
                <textarea name="comment" id="comment"></textarea>
            </div>
            @error('comment')
            <div class="error-message">{{ $message }}</div>
            @enderror
            @error('restaurant_id')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <button type="submit" class="submit">投稿する</button>
        </form>
    </div>
@endsection