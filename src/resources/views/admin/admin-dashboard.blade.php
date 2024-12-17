@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-dashboard.css') }}">
@endsection

@section('main')
<div class="main">
    <h1>管理者ダッシュボード</h1>
    <ul>
        <li><a href="{{ route('admin.shop_owners.list') }}">店舗代表者一覧</a></li>
        <li><a href="{{ route('admin.shop_owners.create') }}">店舗代表者の作成</a></li>
        <li><a href="{{ route('admin.send_email') }}">お知らせメール送信</a></li>
    </ul>
</div>
@endsection
