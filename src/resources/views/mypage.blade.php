@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('main')

<div class="mypage-container">
    <div class="reservation-section">
        <h3>予約状況</h3>
        @foreach($reservations as $index => $reservation)
            <div class="reservation-card">
                <div class="reservation-card__header">
                    <i class="fas fa-clock  clock-icon"></i>
                    <span>予約{{ $index + 1 }}</span>
                    <button class="delete-button" data-reservation-id="{{ $reservation->id }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="reservation-info">
                    <span class="info-label">Shop</span>
                    <span class="info-value">{{ $reservation->restaurant->name }}</span>
                </div>
                <div class="reservation-info">
                    <span class="info-label">Date</span>
                    <span class="info-value">{{ $reservation->reservation_date }}</span>
                </div>
                <div class="reservation-info">
                    <span class="info-label">Time</span>
                    <span>{{ $reservation->formatted_time }}</span>
                </div>
                <div class="reservation-info">
                    <span class="info-label">Number</span>
                    <span>{{ $reservation->reservation_number }}人</span>            
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const reservationId = this.getAttribute('data-reservation-id');
                if (confirm('予約を削除しますか？')) {
                    axios.delete('/delete-reservation', {
                        data: {
                            reservation_id: reservationId
                        }
                    })
                    .then(function (response) {
                        alert(response.data.message);
                        button.closest('.reservation-card').remove();
                    })
                    .catch(function (error) {
                        alert('予約の削除に失敗しました');
                    });
                }
            });
        });
    </script>   

    <div class="user-favorites-section">
        <h2>{{ $userName }}さん</h2>
        <h3>お気に入り店舗</h3>
        <div class="favorite-cards">
            @foreach ($favoriteRestaurants as $favorite)
                <div class="restaurant-card">
                    <img class="restaurant-image" src="{{ $favorite->restaurant->image }}" alt="{{ $favorite->restaurant->name }} Image">
                    <div class="card-body">
                        <h3 class="card-title">{{ $favorite->restaurant->name }}</h3>
                        <div class="card-text-container">
                            <p class="card-text">#{{ $favorite->restaurant->region }}</p>
                            <p class="card-text">#{{ $favorite->restaurant->genre }}</p>
                        </div>
                        <div class="btn-container">
                            <a href="/detail/{{ $favorite->restaurant->id }}" class="btn btn-detail">詳しく見る</a>
                            @auth
                                <form id="remove-favorite-form-{{ $favorite->restaurant->id }}" action="/favorite/remove" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="restaurant_id" value="{{ $favorite->restaurant->id }}">
                                </form>
                                <button class="favorite-btn" data-restaurant-id="{{ $favorite->restaurant->id }}">
                                    <i class="fas fa-heart heart-icon"></i>
                                </button>                       
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/favorite-script.js') }}"></script>
@endsection

