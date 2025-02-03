@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('main')
<div class="main">
  <div class="mypage-header">
    <div class="user-name">
      <h2>{{ $user->name }}さん</h2>
    </div>
    <div class="mypage-link">
      <a href="{{ route('review.posts') }}" class="list-btn">投稿したレビュー</a>
      <a href="{{ route('payment.list') }}" class="list-btn">支払いページ</a>
    </div>
  </div>
  <div class="flex between mypage">
    <div class="status">
      <h3 class="status__ttl">予約状況</h3>
      @foreach ($user->reservations as $reservation)
      <div class="status__card">
        <div class="status__card__top">
          <img src="/img/time.png" alt="time-icon" width="25px" height="25px" />
          <p>予約{{ $reservation->id }}</p>
        </div>
        <div class="qrcode__link">
          <a href="{{ route('qr.show', ['reservation_id' => $reservation->id]) }}" class="qr-link">
            QRコードを表示
          </a>
        </div>
        <table class="status__card__bottom">
          <tr>
            <td>Shop</td>
            <td>{{ $reservation->shop->name ?? '店舗情報なし' }}</td>
          </tr>
          <tr>
            <td>Date</td>
            <td>
                <span class="date-year">{{ $reservation->date->format('Y年') }}</span>
                <span class="date-mdw">{{ $reservation->date->format('m月d日') }}({{ ['日', '月', '火', '水', '木', '金', '土'][$reservation->date->dayOfWeek] }})</span>
            </td>
          </tr>
          <tr>
            <td>Time</td>
            <td>{{ $reservation->time->format('H:i') }}</td>
          </tr>
          <tr>
            <td>Number</td>
            <td>{{ $reservation->user_num }}人</td>
          </tr>
        </table>
        <form class="ml-a" method="GET" action="{{ route('reserve.edit', ['reservation_id' => $reservation->id]) }}">
            @csrf
            <div class="reservation-actions">
              <a href="{{ route('reserve.edit', ['reservation_id' => $reservation->id]) }}" class="edit-link">
                  予約変更・削除
              </a>
            </div>
        </form>
      </div>
    @endforeach
    </div>
    <div class="likes">
      <h3 class="likes__ttl">お気に入り店舗</h3>
      <div class="flex card-wrapper between wrap">
        @foreach($user->likes as $shop)
        <div class="shop-card">
          <img class="shop-card__img" src="{!! $shop->image_url !!}" alt="shop-img" />
          <div class="shop-card__content">
            <h2 class="shop-card__content__ttl">{{$shop->name}}</h2>
            <p class="shop-card__content__txt">
              #{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}
            </p>
            <div class="flex align-items-center between">
              <a class="shop-card__content__link" href="{!! '/detail/' . $shop->id !!}">
                詳しくみる
              </a>
              @if(count($shop->likes)==0)
              <form method="POST" action="{{ route('like', ['shop_id' => $shop->id]) }}">
                @csrf
                <input class="shop-card__content__icon inactive" type="image" src="/img/unlike.png" alt="いいね" width="32px" height="32px">
              </form>
              @else
              <form class="ml-a" method="POST" action="{{ route('unlike', ['shop_id' => $shop->id]) }}">
                @csrf
                <input class="shop-card__content__icon inactive" type="image" src="/img/like.png" alt="いいねを外す" width="32px" height="32px">
              </form>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection