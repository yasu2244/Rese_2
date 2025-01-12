@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop-list.css') }}">
@endsection

@section('main')
<h1 class="title">担当店舗一覧</h1>
<div class="main-container">
    <table class="shop-list-table">
        <thead>
            <tr>
                <th>店舗名</th>
                <th>地域</th>
                <th>ジャンル</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shops as $shop)
            <tr>
                <td>{{ $shop->name }}</td>
                <td>{{ $shop->area->name }}</td>
                <td>{{ $shop->genre->name }}</td>
                <td class="actions">
                    <a href="{{ route('owner.shops.update', $shop->id) }}" class="btn btn-edit">編集</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="btn-container">
    <a href="{{ route('owner.dashboard') }}" class="btn btn-back">戻る</a>
</div>
@endsection
