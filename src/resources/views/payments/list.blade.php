@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payments/list.css') }}">
@endsection

@section('main')
<div class="main">
  <div class="list-header">
    <a class="back-btn" href="{{ route('mypage') }}">＜</a>
    <h2 class="list-title">支払いページ</h2>
  </div>

  @foreach($unpaidReservations as $reservation)
  <div class="reservation">
    <p>予約ID: {{ $reservation->id }}</p>
    <p>店舗名: {{ $reservation->shop->name }}</p>
    <p>予約日時: {{ $reservation->date->format('Y年m月d日') }} {{ $reservation->time->format('H:i') }}</p>
    <p>金額: ¥{{ number_format(optional($reservation->payment)->amount ?? 0) }}</p>
    
    <!-- 支払い方法選択 -->
    <div class="payment-methods">
      <!-- カード決済 -->
      <button class="btn pay-button" data-reservation-id="{{ $reservation->id }}">
        カードで支払う
      </button>
      <!-- QRコード決済 -->
      <a href="{{ route('payment.qr.show', ['reservation_id' => $reservation->id]) }}" 
        class="btn qr-button"
        data-reservation-id="{{ $reservation->id }}"
        data-method="qr_code">
        QRコードで支払う
      </a>


    </div>

    <!-- フォーム：カード決済 -->
    <form id="card-form-{{ $reservation->id }}" action="{{ route('payment.session') }}" method="POST" style="display: none;">
      @csrf
      <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
    </form>

  </div>
  @endforeach

  <div class="btn-container">
      <a href="{{ route('mypage') }}" class="btn btn-mypage">マイページへ戻る</a>
  </div>

</div>
@endsection

@section('scripts')
<script>
    const stripePublicKey = "{{ config('services.stripe.key') }}";
</script>
<script src="{{ asset('js/updatePaymentMethod.js') }}"></script>
<script src="{{ asset('js/payment.js') }}"></script>
@endsection

