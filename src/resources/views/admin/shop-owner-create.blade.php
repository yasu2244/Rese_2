@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop-owner-create.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>店舗代表者作成</h1>
    <form action="{{ route('admin.shop_owners.store') }}" method="post" class="form">
        @csrf
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">作成</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">戻る</a>
        </div>
    </form>
</div>
@endsection
