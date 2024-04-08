@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/create_restaurant.css') }}">
@endsection

@section('main')

<div class="form-container">
        <h2>店舗情報作成フォーム</h2>

        <form method="POST"  action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
            @csrf

            <label class="label" for="name">店舗名:</label>
            <input type="text" id="name" name="name" class="input-text" required><br>

            <label class="label" for="region">地域(県名):</label>
            <input type="text" id="region" name="region" class="input-text" required><br>

            <label class="label" for="genre">ジャンル:</label>
            <input type="text" id="genre" name="genre" class="input-text" required><br>

            <label class="label" for="description">説明:</label><br>
            <textarea id="description" name="description" class="textarea" required></textarea><br>

            <label class="label" for="image">画像:</label>
            <input type="file" id="image" name="image" class="input-file" accept="image/*" required><br>

            <div class="button-cover">
                <button type="submit" class="button-submit">登録</button>
            </div>
        </form>
    </div>

@endsection