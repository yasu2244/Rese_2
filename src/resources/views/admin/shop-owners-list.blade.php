@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop-owners-list.css') }}">
@endsection

@section('main')
<h1 class="title">店舗代表者一覧</h1>
<div class="main-container">
    <table class="shop-owners-table">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shopOwners as $shopOwner)
            <tr>
                <td>{{ $shopOwner->name }}</td>
                <td>{{ $shopOwner->email }}</td>
                <td class="actions">
                    <a href="{{ route('admin.shop_owners.stores', ['id' => $shopOwner->id]) }}" class="btn btn-info">担当店舗</a>
                    <a href="{{ route('admin.shop_owners.edit', $shopOwner->id) }}" class="btn btn-edit">編集</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="btn-container">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-back">戻る</a>
</div>
@endsection
