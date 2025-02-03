@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payments/success.css') }}">
@endsection

@section('main')

<div class="main">
    <h2>支払いが完了しました！</h2>

    <p>予約ID: {{ $payment->reservation->id }}</p>
    <p>店舗名: {{ $payment->reservation->shop->name }}</p>
    <p>ご利用ありがとうございます。</p>

    <div class="btn-container">
        <a href="{{ route('mypage') }}" class="btn btn-mypage">マイページへ戻る</a>
    </div>

</div>

@endsection
