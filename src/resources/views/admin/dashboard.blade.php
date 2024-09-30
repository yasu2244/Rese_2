@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('main')

<div class="container">
    <div class="shop-entry-section">
        <h1 class="heading">新規店舗情報の登録</h1>
        <div class="form-wrapper">
            <form method="POST" action="{{ url('admin/store') }}" id="shop_form">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="label">店舗名 (50文字以内)</label>
                    <input type="text" name="name" id="name" class="form-control" maxlength="50" required value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-red-500">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="area" class="label">地域</label>
                    <select name="area" id="area" class="form-control" required>
                        <option value="">選択してください</option>
                        <option value="東京都" {{ old('area') == '東京都' ? 'selected' : '' }}>東京都</option>
                        <option value="大阪府" {{ old('area') == '大阪府' ? 'selected' : '' }}>大阪府</option>
                        <option value="福岡県" {{ old('area') == '福岡県' ? 'selected' : '' }}>福岡県</option>
                    </select>
                    @if ($errors->has('area'))
                        <span class="text-red-500">{{ $errors->first('area') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="genre" class="label">ジャンル</label>
                    <select name="genre" id="genre" class="form-control" required>
                        <option value="">選択してください</option>
                        <option value="寿司" {{ old('genre') == '寿司' ? 'selected' : '' }}>寿司</option>
                        <option value="焼肉" {{ old('genre') == '焼肉' ? 'selected' : '' }}>焼肉</option>
                        <option value="イタリアン" {{ old('genre') == 'イタリアン' ? 'selected' : '' }}>イタリアン</option>
                        <option value="居酒屋" {{ old('genre') == '居酒屋' ? 'selected' : '' }}>居酒屋</option>
                        <option value="ラーメン" {{ old('genre') == 'ラーメン' ? 'selected' : '' }}>ラーメン</option>
                    </select>
                    @if ($errors->has('genre'))
                        <span class="text-red-500">{{ $errors->first('genre') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description" class="label">店舗概要 (400文字以内)</label>
                    <textarea name="description" id="description" class="form-control" maxlength="400" rows="5" required>{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-red-500">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="image" class="label">画像アップロード (jpegまたはpng形式のみ)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/jpeg,image/png" required>
                    @if ($errors->has('image'))
                        <span class="text-red-500">{{ $errors->first('image') }}</span>
                    @endif
                </div>

                <div class="submit-btn-wrapper">
                    <button type="submit" class="submit-btn">店舗を登録</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
