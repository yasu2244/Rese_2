@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop-list.css') }}">
@endsection

@section('main')
<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>店舗名</th>
                <th>店舗責任者</th>
                <th>店舗責任者Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>店舗A</td>
                <td>田中太郎</td>
                <td>t.tanaka@example.com</td>
            </tr>
            <tr>
                <td>店舗B</td>
                <td>山田花子</td>
                <td>y.yamada@example.com</td>
            </tr>
            <tr>
                <td>店舗C</td>
                <td>佐藤次郎</td>
                <td>s.sato@example.com</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection