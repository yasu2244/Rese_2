@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')
<div class="main flex">
  <div class="shop-detail">
    <div class="flex align-items-center">
      <a class="shop-detail__link" href="/">＜</a>
      <h2 class="shop-detail__ttl">{{$shop->name}}</h2>
    </div>
    <img class="shop-detail__img" src="{!! $shop->image_url !!}" alt="shop-img" width="100%" />
    <p class="shop-detail__tag">#{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}</p>
    <p class="shop-detail__txt">{{$shop->description}}</p>

    <a href="{{ route('review.all', ['shop_id' => $shop->id]) }}" class="all-reviews-link">全ての口コミ情報</a>

    @auth
    @if (is_null($userReview))
        <a href="{{ route('review.create', ['shop_id' => $shop->id]) }}" class="rate-button">口コミを投稿する</a>
    @else
        <div class="user-review">
          <div class="user-review__header">
            <a href="{{ route('review.edit', ['id' => $userReview->id]) }}" class="edit-button">口コミを編集</a>
            <form action="{{ route('review.destroy', ['id' => $userReview->id]) }}" method="POST" class="delete-form" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？')">口コミを削除</button>
            </form>
          </div>
          <div class="user-review__main">
              <p class="rating">{{ str_repeat('★', $userReview->rating) }}</p>
              <p class="comment">{{ $userReview->comment }}</p>

              @if ($userReview->image_path)
                <div class="review-image">
                    <img src="{{ asset('storage/' . $userReview->image_path) }}" alt="Review Image" width="200">
                </div>
            @endif
          </div>
        </div>
    @endif
@endauth

  </div>

  <div class="reservation">
    <form class="reservation-card" action="/reservation" method="POST">
      @csrf
      <div class="reservation-card__content">
        <h2 class="reservation-card__content__ttl">予約</h2>
        @if (count($errors) > 0)
        <ul class="error__lists">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif
        <input type="hidden" name="shop_id" value="{!! $shop->id !!}">
        <input class="reservation-card__date-input" type="date" value="{!! $today !!}" name="date" id="date" />
        <div class="reservation-card__pull-down">
          <select name="time" id="time">
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <option value="13:00">13:00</option>
            <option value="14:00">14:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
            <option value="21:00">21:00</option>
            <option value="22:00">22:00</option>
          </select>
        </div>
        <div class="reservation-card__pull-down">
          <select name="user_num" id="user_num">
            <option value="1">1人</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">4人</option>
          </select>
        </div>
        <div class="reservation-details">
          <p>Shop: <span id="shop-name">{{$shop->name}}</span></p>
          <p>Date: <span id="selected-date"></span></p>
          <p>Time: <span id="selected-time"></span></p>
          <p>Number: <span id="selected-number"></span></p>
        </div>
      </div>
      <input type="submit" class="reservation-btn" value="予約する">
    </form>
  </div>
  
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/reservation.js') }}"></script>
@endsection
