@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')

<div class="shop-detail">
    <div class="info">
        <div class="info-header">
            <a href="/" class="back-button">
                <i class="fas fa-angle-left"></i>
            </a>
            <h2 class="shop-name">{{ $restaurant->name }}</h2>
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
    <div class="reservation-form">
        <div class="reservation-header">
            <h3>予約</h3>
        </div>

        <!-- 後で/reservation/confirmに変える -->
        <form action="" method="POST" class="reservation-form__body"> 
            @csrf
            <div class="reservation-form__group">
                <!-- 日付選択 -->
                <label for="date"></label>
                <input class="date-form" type="date" id="date" name="date" required>
            </div>
            <div class="reservation-form__group">
                <!-- 時間選択 -->
                <label for="time"></label>
                <select class="time-form" id="time" name="time" required>
                    <option value="">選択してください</option>
                    <?php
                        $currentTime = \Carbon\Carbon::now();

                        for ($hour = 0; $hour < 24; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += 30) {
                                // オプションの値と表示を生成
                                $time = sprintf('%02d:%02d', $hour, $minute);
                                // 現在時刻以降の場合にのみオプションを生成
                                if ($currentTime <= \Carbon\Carbon::createFromFormat('H:i', $time)) {
                                    echo "<option value=\"$time\">$time</option>";
                                }
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="reservation-form__group">
                <!-- 人数選択 -->
                <label for="number"></label>
                <select class="number-form" id="number" name="number" required>
                    <option value="">選択してください</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="reservation-details">
                <p>Shop<span id="shop-name">{{ $restaurant->name }}</span></p>
                <p>Date<span id="selected-date"></span></p>
                <p>Time<span id="selected-time"></span></p>
                <p>Number<span id="selected-people"></span></p>
            </div>
            <button type="submit" class="reserve-button">予約する</button>
        </form>
    </div>
</div>

<script>
    // フォーム要素を取得
    const form = document.querySelector('.reservation-form__body');

    // フォームのイベントリスナーを設定
    form.addEventListener('change', () => {
        // 日付、時間、人数の要素を取得
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        const people = document.getElementById('number').value;

        // 取得した値を表示
        document.getElementById('selected-date').textContent = date;
        document.getElementById('selected-time').textContent = time;
        document.getElementById('selected-people').textContent = people;
    });
</script>
@endsection