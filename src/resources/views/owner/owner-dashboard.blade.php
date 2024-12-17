@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/owner-dashboard.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>店舗代表者ダッシュボード</h1>
    <ul>
        <li><a href="{{ route('owner.shops.create') }}">店舗の作成</a></li>
        <li><a href="{{ route('owner.shops.update') }}">店舗の更新</a></li>
        <li><a href="{{ route('owner.reservations.index') }}">予約状況の確認</a></li>
    </ul>
</div>
@endsection
