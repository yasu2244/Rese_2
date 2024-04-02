<div class="card-container" id="searchResults">
    @foreach ($restaurants as $restaurant)
    <div class="restaurant-card">
        <img class="restaurant-image" src="{{ $restaurant->image }}" alt="{{ $restaurant->name }} Image">
        <div class="card-body">
            <h3 class="card-title">{{ $restaurant->name }}</h3>
            <?php if(isset($averageRatings) && $averageRatings->isNotEmpty()): ?>
                @foreach ($averageRatings as $averageRating)
                    <p>平均評価: {{ $averageRating->average_rating }}</p>
                @endforeach
            <?php else: ?>
                <p>評価: NoRating</p>
            <?php endif; ?>
                    <div class="card-text-container">
                <p class="card-text">#{{ $restaurant->region }}</p>
                <p class="card-text">#{{ $restaurant->genre }}</p>
            </div>
            <div class="btn-container">
                <a href="/detail/{{ $restaurant->id }}" class="btn btn-detail" onclick="setReferringPage('/');">詳しく見る</a>
                @auth  
                    <form id="add-favorite-form" action="/favorite/add" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="restaurant_id" id="add-favorite-restaurant-id">
                    </form>

                    <form id="remove-favorite-form" action="/favorite/remove" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="restaurant_id" id="remove-favorite-restaurant-id">
                    </form>
                    <button class="favorite-btn" data-restaurant-id="{{ $restaurant->id }}">
                        <i class="fas fa-heart heart-icon"></i>
                    </button>                       
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>