@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')
<div class="shop-detail">
    <div class="info">
        <div class="info-header">
            <button class="back-button" onclick="goBack();">
                <i class="fas fa-angle-left"></i>
            </button>
            <h2 class="shop-name">{{ $restaurant->name }}</h2>
            @auth
                <a href="{{ route('review.create', ['restaurant_id' => $restaurant->id]) }}" class="rate-button">レビューする</a>
            @endauth
        </div>
        <div class="info-container">
            <img class="shop-image" src="{{ $restaurant->image }}" alt="{{ $restaurant->name }} Image">
            <div class="shop-tags">
                <p class="shop-tag">#{{ $restaurant->region }}</p>
                <p class="shop-tag">#{{ $restaurant->genre }}</p>
            </div>
        </div>
            <p class="shop-description">{{ $restaurant->description }}</p>
    </div>

    <!-- 予約フォーム -->
    <div class="reservation-form">
        <div class="reservation-header">
            <h3>予約</h3>
        </div>
        <form action="{{ route('reservation.confirm') }}" method="POST" class="reservation-form__body">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <div class="reservation-form__group">
                <label for="date"></label>
                <input class="date-form" type="text" id="date" name="reservation_date" value="日付を選択してください" required>
            </div>
            <div class="reservation-form__group">
                <label for="time"></label>
                <select class="time-form" id="time" name="reservation_time" required>
                    <option value="">時間を選択してください</option>
                     <?php
                       $currentTime = \Carbon\Carbon::now();
                        for ($hour = 0; $hour < 24; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += 30) {
                                // 時間を24時間表記の文字列にフォーマット
                                $time = sprintf('%02d:%02d', $hour, $minute);
                                
                                echo "<option value=\"$time\">$time</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="reservation-form__group">
                <label for="number"></label>
                <select class="number-form" id="number" name="reservation_number" required>
                    <option value="">人数を選択してください</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="reservation-details">
                <p>Shop<span id="shop-name">{{ $restaurant->name }}</span></p>
                <p>Date<span id="selected-date"></span></p>
                <p>Time<span id="selected-time"></span></p>
                <p>Number<span id="selected-number"></span></p>
            </div>
            <button type="submit" class="reserve-button">予約する</button>
        </form>
    </div>
</div>

<script>
// 戻るボタンのクリックイベントを処理する関数
function goBack() {
    // 直前のURLを取得
    var previousUrl = "{{ Session::get('previousUrl') }}";
    var currentRestaurantId = "{{ $restaurant->id }}";
    
    // 直前のURLが存在し、かつ予約完了ページまたはレビュー投稿ページである場合
   if (previousUrl) {
        if (previousUrl.includes('reservation/done')) {
            // 直前のページが予約完了ページの場合、ブラウザの履歴を3つ戻る
            window.history.go(-3);
            return;
        } else if (previousUrl.includes('review/')) {
            // 直前のページがレビュー投稿ページの場合、restaurant_idを抽出して比較
            var match = previousUrl.match(/review\/(\d+)/);
            if (match) {
                var previousRestaurantId = match[1];
                if (previousRestaurantId == currentRestaurantId) {
                    // restaurant_idが一致した場合、ブラウザの履歴を3つ戻る
                    window.history.go(-3);
                    return;
                }
            }
        }
    }
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script> //日付選択
    $(document).ready(function() {
        $('#date').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText) {
                $('#selected-date').text(dateText);
            }
        });
    });
</script>
<script>
    const form = document.querySelector('.reservation-form__body');

    form.addEventListener('change', () => {

        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        const number = document.getElementById('number').value;

        document.getElementById('selected-date').textContent = date;
        document.getElementById('selected-time').textContent = time;
        document.getElementById('selected-number').textContent = number;
    });
</script>
@endsection

