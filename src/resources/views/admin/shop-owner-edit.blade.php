@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop-owner-edit.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>{{ $shopOwner->name }} さんの編集</h1>

    <!-- 更新用フォーム -->
    <form action="{{ route('admin.shop_owners.update', $shopOwner->id) }}" method="post">
        @csrf
        @method('PUT')

        <!-- 名前の編集 -->
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" id="name" name="name" value="{{ old('name', $shopOwner->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- メールアドレスの編集 -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email', $shopOwner->email) }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- 担当店舗の選択 -->
        <div class="form-group">
            <label for="shops">担当店舗</label>
            <div class="shop-checkboxes">
                @foreach ($shops as $shop)
                <div>
                    <label for="shop_{{ $shop->id }}">
                        <input type="checkbox" id="shop_{{ $shop->id }}" name="shops[]" value="{{ $shop->id }}" 
                            @if($shopOwner->shops->contains($shop->id)) checked @endif>
                        {{ $shop->name }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('shops.*')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- ボタンエリア -->
        <div class="button-group">
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('admin.shop_owners.list') }}" class="btn btn-secondary">キャンセル</a>
            </div>
        </div>
    </form>

    <!-- 削除用フォーム -->
    <form action="{{ route('admin.shop_owners.destroy', $shopOwner->id) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>
</div>
@endsection
