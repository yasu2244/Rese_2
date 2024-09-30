@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review/personal-list.css') }}">
@endsection

@section('main')

@foreach ($reviews as $review)
    <div class="review-item">
        <h2>{{ $review->shop->name }}</h2>
        <p class="rating">{{ str_repeat('★', $review->rating) }}</p> <!-- $userReview -> $review に変更 -->
        <p class="comment">{{ $review->comment ? $review->comment : 'コメントなし' }}</p>

        <!-- 画像の表示 -->
        @if ($review->image_path)
            <div class="review-image">
                <img src="{{ asset('storage/' . $review->image_path) }}" alt="Review Image" width="200">
            </div>
        @endif

        <div class="buttons">
            <a href="{{ route('review.edit', $review->id) }}" class="btn btn-edit">編集</a>
            <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </div>
    </div>
@endforeach



@endsection