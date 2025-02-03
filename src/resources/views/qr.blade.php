@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qr.css') }}">
@endsection

@section('main')
<h2>QRコード</h2>
<div class="qrcode">
    {!! $qr_code !!}
</div>
<div class="btn-container">
    <a href="{{ route('mypage') }}" class="btn">戻る</a>
</div>

@endsection