@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qr.css') }}">
@endsection

@section('main')
<h2>QRコード決済</h2>
<p>以下のQRコードをスキャンして決済を完了してください。</p>
<div class="qrcode">
    {!! $qr_code !!}
</div>

<div class="btn-container">
    <button id="check-payment-status" class="btn">支払い完了を確認</button>
</div>

<div class="btn-container">
    <a href="{{ route('mypage') }}" class="btn">戻る</a>
</div>

<input type="hidden" id="reservation-id" value="{{ $reservationId }}">

@endsection

@section('scripts')
<script src="{{ asset('js/updatePaymentMethods.js') }}"></script>
<script src="{{ asset('js/qrPayment.js') }}"></script>
@endsection
