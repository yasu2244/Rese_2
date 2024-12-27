@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop-update.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>店舗更新</h1>
    @foreach ($shops as $shop)
    <form action="{{ route('owner.shops.update.process', $shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name_{{ $shop->id }}">店舗名</label>
            <input type="text" id="name_{{ $shop->id }}" name="name" value="{{ $shop->name }}" required>
        </div>
        <div>
            <label for="area_id_{{ $shop->id }}">地域</label>
            <select id="area_id_{{ $shop->id }}" name="area_id" required>
                <option value="">選択してください</option>
                @foreach ($areas as $area)
                <option value="{{ $area->id }}" @if($shop->area_id == $area->id) selected @endif>
                    {{ $area->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="genre_id_{{ $shop->id }}">ジャンル</label>
            <select id="genre_id_{{ $shop->id }}" name="genre_id" required>
                <option value="">選択してください</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @if($shop->genre_id == $genre->id) selected @endif>
                    {{ $genre->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="description_{{ $shop->id }}">説明</label>
            <textarea id="description_{{ $shop->id }}" name="description" required>{{ $shop->description }}</textarea>
        </div>
        <div>
            <label for="image_{{ $shop->id }}">店舗画像</label>
            <input type="file" id="image_{{ $shop->id }}" name="image" accept="image/*">
            @if ($shop->image_url)
                <img src="{{ $shop->image_url }}" alt="店舗画像" class="preview-image">
            @endif
        </div>

        <button type="submit">更新</button>
    </form>
    @endforeach
</div>
@endsection
