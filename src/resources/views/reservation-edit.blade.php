@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation-edit.css') }}">
@endsection

@section('main')
<div class="main">
    <div class="edit-header">
        <a class="back-btn" href="{{ route('mypage') }}">＜</a>
        <h2 class="page__title">予約内容の編集</h2>
    </div>

    <div class="edit-container">
        <form class="reservation-form" action="{{ route('reserve.update', ['reservation_id' => $reservation->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="reservation-form__content">
                <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                
                <div class="reservation-form__group">
                    <label for="date" class="reservation-form__label">日付</label>
                    <input class="reservation-form__input" type="date" value="{{ old('date', $reservation->date) }}" name="date" id="date" required>
                    @error('date')
                        <span class="reservation-form__error-message">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="reservation-form__group">
                    <label for="time" class="reservation-form__label">時間</label>
                    <select name="time" id="time" class="reservation-form__select" required>
                        <option value="">時間を選択してください</option>
                        @foreach ($timeSlots as $time)
                            <option value="{{ $time }}" {{ $reservation->time === $time ? 'selected' : '' }}>
                                {{ $time }}
                            </option>
                        @endforeach
                    </select>
                    @error('time')
                        <span class="reservation-form__error-message">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="reservation-form__group">
                    <label for="user_num" class="reservation-form__label">人数</label>
                    <select class="reservation-form__select" name="user_num" id="user_num" required>
                        <option value="">人数を選択してください</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ $reservation->user_num == $i ? 'selected' : '' }}>
                                {{ $i }}人
                            </option>
                        @endfor
                    </select>
                    @error('user_num')
                        <span class="reservation-form__error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- 更新ボタン -->
            <div class="reservation-form__actions">
                <input type="submit" class="reservation-form__button reservation-form__button--update" value="予約を更新する">
            </div>
        </form>
    
        <!-- 削除ボタン -->
        <form class="reservation-form__delete" action="{{ route('reserve.destroy', ['reservation_id' => $reservation->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="reservation-form__button reservation-form__button--delete" onclick="return confirm('本当に削除しますか？')">
                予約を削除する
            </button>
        </form>
    </div>
</div>
@endsection
