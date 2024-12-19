@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop-update.css') }}">
@endsection


@section('main')
<div class="main">
    <h1>店舗更新</h1>
    @foreach ($shops as $shop)
    <form action="{{ route('owner.shops.update.process', $shop->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name_{{ $shop->id }}">店舗名</label>
            <input type="text" id="name_{{ $shop->id }}" name="name" value="{{ $shop->name }}" required>
        </div>
        <div>
            <label for="description_{{ $shop->id }}">説明</label>
            <textarea id="description_{{ $shop->id }}" name="description" required>{{ $shop->description }}</textarea>
        </div>
        <button type="submit">更新</button>
    </form>
    @endforeach
</div>
@endsection
