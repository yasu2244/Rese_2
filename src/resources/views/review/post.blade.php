@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review/post.css') }}">
@endsection

@section('main')
<div class="review-container">
    <!-- 左カラム: タイトルと店舗情報 -->
    <div class="review-left">
        <h1 class="review-title">今回のご利用はいかがでしたか？</h1>

        <div class="shop-card">
            <img class="shop-card__img" src="{!! $shop->image_url !!}" alt="shop-img" />
            <div class="shop-card__content">
                <h2 class="shop-card__content__ttl">{{$shop->name}}</h2>
                <p class="shop-card__content__txt">
                    #{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}
                </p>
                <div class="flex align-items-center">
                    <a class="shop-card__content__link" href="{!! '/detail/' . $shop->id !!}">
                        詳しくみる
                    </a>
                    @if( Auth::check() )
                        @if(count($shop->likes) == 0)
                        <form class="ml-a" method="POST" action="{{ route('like', ['shop_id' => $shop->id]) }}">
                        @csrf
                        <input class="shop-card__content__icon inactive" type="image" src="/img/unlike.png" alt="いいね" width="32px" height="32px">
                        </form>
                        @else
                        <form class="ml-a" method="POST" action="{{ route('unlike', ['shop_id' => $shop->id]) }}">
                        @csrf
                        <input class="shop-card__content__icon inactive" type="image" src="/img/like.png" alt="いいねを外す" width="32px" height="32px">
                        </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @error('shop_id')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- 右カラム: レビュー投稿フォーム -->
    <div class="review-form">
        <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <!-- 評価選択 (星評価) -->
            <div class="rating-section">
                <h2>体験を評価してください</h2>
                <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">★</label>
                </div>
                <span class="required">※必須</span>
                @error('rating')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- コメントエリア -->
            <div class="comment-area">
                <h2>口コミを投稿</h2>
                <textarea name="comment" id="comment" placeholder="カジュアルな夜のお出かけにおすすめのスポット" maxlength="400"></textarea>
                <span class="char-counter" id="char-counter">0/400 (最高文字数)</span> <!-- テキストエリアの下に配置 -->
            </div>
            @error('comment')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- 画像の追加 -->
            <div class="image-upload" id="image-upload-area">
                <h2>画像の追加</h2>
                <div class="image-drop-area" id="drop-area">
                    <input type="file" name="image" id="images" class="image-input" accept=".jpeg,.jpg,.png" style="display:none;">
                    <p id="upload-text">クリックして写真を追加<br>またはドラッグアンドドロップ</p>
                    <div id="image-preview" class="image-preview"></div>
                </div>
            </div>

            @error('images')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-btn">口コミを投稿</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/count.js') }}"></script>
<script src="{{ asset('js/file-preview.js') }}"></script>
@endsection
