@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review-posts_list.css') }}">
@endsection

@section('main')

@foreach ($reviews as $review)
    <div class="review-item">
        <p>shop名: {{ $review->restaurant->name }}</p>
        <p>評価: {{ $review->rating }}</p>
        <p>コメント: {{ $review->comment ? $review->comment : 'なし' }}</p>
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