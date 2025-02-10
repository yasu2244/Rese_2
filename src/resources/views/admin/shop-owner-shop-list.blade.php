@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop-owner-shop-list.css') }}">
@endsection

@section('main')
<div class="main">
    <h2>{{ $shopOwner->name }} さんの担当店舗一覧</h2>
    <table>
        <thead>
            <tr>
                <th>店舗ID</th>
                <th>店舗名</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stores as $store)
            <tr>
                <td>{{ $store->id }}</td>
                <td>{{ $store->name }}</td>
                <td>
                    <a href="{{ route('admin.shop.detail', ['shop_id' => $store->id]) }}" class="btn btn-info">詳細を見る</a>
                    <form action="{{ route('admin.stores.destroy', ['id' => $store->id]) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')">店舗削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.shop_owners.list') }}" class="btn btn-secondary">店舗代表者一覧に戻る</a>
</div>
@endsection
