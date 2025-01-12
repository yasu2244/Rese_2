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
    <img class="shop-detail__img" src="{{ asset($shop->image_url) }}" alt="shop-img" width="100%" />
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
    <form class="reservation-card" action="/reservation/completion" method="POST">
      @csrf
      <div class="reservation-card__content">
        <h2 class="reservation-card__content__ttl">予約</h2>
        @if ($errors->any())
          <div class="error__container">
            <ul class="error__lists">
              @foreach ($errors->all() as $error)
              <li class="error__item">{{$error}}</li>
              @endforeach
            </ul>
          </div>
          @endif
        <input type="hidden" name="shop_id" value="{!! $shop->id !!}">
        <input class="reservation-card__date-input" type="date" value="{!! $today !!}" name="date" id="date" />
        <div class="reservation-card__pull-down">
          <select name="time" id="time">
              <option value="">時間を選択してください</option>
              @foreach ($timeSlots as $time)
                  <option value="{{ $time }}">{{ $time }}</option>
              @endforeach
          </select>
        </div>
        <div class="reservation-card__pull-down">
          <select class="number-form" name="user_num" id="user_num">
            <option value="">人数を選択してください</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}人</option>
            @endfor
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
