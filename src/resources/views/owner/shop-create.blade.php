@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop-create.css') }}">
@endsection

@section('main')

<div class="container">
    <div class="shop-entry-section">
        <h1 class="heading">新規店舗情報の登録</h1>
        <div class="form-wrapper">
            <form method="POST" action="{{ route('owner.shops.store') }}" id="shop_form" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="label">店舗名 (20文字以内)</label>
                    <input type="text" name="name" id="name" class="form-control" maxlength="20" required value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="area_id" class="label">地域</label>
                    <select name="area_id" id="area_id" class="form-control" required>
                        <option value="">選択してください</option>
                        <option value="1" {{ old('area_id') == 1 ? 'selected' : '' }}>東京都</option>
                        <option value="2" {{ old('area_id') == 2 ? 'selected' : '' }}>大阪府</option>
                        <option value="3" {{ old('area_id') == 3 ? 'selected' : '' }}>福岡県</option>
                    </select>
                    @error('area_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="genre_id" class="label">ジャンル</label>
                    <select name="genre_id" id="genre_id" class="form-control" required>
                        <option value="">選択してください</option>
                        <option value="1" {{ old('genre_id') == 1 ? 'selected' : '' }}>寿司</option>
                        <option value="2" {{ old('genre_id') == 2 ? 'selected' : '' }}>焼肉</option>
                        <option value="3" {{ old('genre_id') == 3 ? 'selected' : '' }}>イタリアン</option>
                        <option value="4" {{ old('genre_id') == 4 ? 'selected' : '' }}>居酒屋</option>
                        <option value="5" {{ old('genre_id') == 5 ? 'selected' : '' }}>ラーメン</option>
                    </select>
                    @error('genre_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="label">店舗概要 (400文字以内)</label>
                    <textarea name="description" id="description" class="form-control" maxlength="400" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="label">画像アップロード (jpegまたはpng形式のみ)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/jpeg,image/png" required>
                    @error('image')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="button-group">
                    <button type="submit" class="submit-btn">店舗を登録</button>
                    <a href="{{ route('owner.dashboard') }}" class="cancel-btn">キャンセル</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
