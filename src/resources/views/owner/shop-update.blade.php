@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop-update.css') }}">
@endsection

@section('main')
<div class="main">
    <div class="shop-update__header">
        <a class="shop-update__link" href="{{ route('owner.shops.list') }}">＜</a>
        <h2 class="shop-update__ttl">店舗編集</h2>
    </div>
    <form action="{{ route('owner.shops.update.process', $shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">店舗名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $shop->name) }}" class="@error('name') is-invalid @enderror">
            @error('name')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="area_id">地域</label>
            <select id="area_id" name="area_id" class="@error('area_id') is-invalid @enderror">
                <option value="">選択してください</option>
                @foreach ($areas as $area)
                <option value="{{ $area->id }}" @if($shop->area_id == $area->id) selected @endif>
                    {{ $area->name }}
                </option>
                @endforeach
            </select>
            @error('area_id')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="genre_id">ジャンル</label>
            <select id="genre_id" name="genre_id" class="@error('genre_id') is-invalid @enderror">
                <option value="">選択してください</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @if($shop->genre_id == $genre->id) selected @endif>
                    {{ $genre->name }}
                </option>
                @endforeach
            </select>
            @error('genre_id')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="description">説明</label>
            <textarea id="description" name="description" class="@error('description') is-invalid @enderror">{{ old('description', $shop->description) }}</textarea>
            @error('description')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="image">店舗画像</label>
            <input type="file" id="image" name="image" accept="image/*" class="@error('image') is-invalid @enderror">
            <div id="image-preview-container">
                <img src="{{ asset($shop->image_url) }}" alt="店舗画像" id="image-preview" class="preview-image">
            </div>
            @error('image')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">更新</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/image-preview.js') }}"></script>
@endsection
