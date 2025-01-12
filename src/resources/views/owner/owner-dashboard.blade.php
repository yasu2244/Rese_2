@extends('layouts.app')

<!-- admin-dashoboardとcssを共有 -->
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-dashboard.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>店舗代表者ダッシュボード</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        <li><a href="{{ route('owner.shops.create') }}">店舗の作成</a></li>
        <li><a href="{{ route('owner.shops.list') }}">店舗の一覧</a></li>
        <li><a href="{{ route('owner.reservations.index') }}">予約状況の確認</a></li>
    </ul>
</div>
@endsection
