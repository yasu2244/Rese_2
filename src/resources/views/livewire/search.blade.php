<div class="restaurant-list">
    <div class="search-form">
        <form action="/" method="GET" class="search-form" id="searchForm">
            <div class="search-form__outer-frame">
                <select wire:model="selectedArea" name="area" class="area" autocomplete="address-level1">
                    <option value="">All area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area }}">{{ $area }}</option>
                    @endforeach
                </select>
                <select wire:model="selectedGenre" name="genre" class="genre" autocomplete="off">
                    <option value="">All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}">{{ $genre }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model.debounce.300ms="searchTerm" name="name" class="name" placeholder="Search..." autocomplete="off">                
            </div>
        </form>
    </div>
    
    @if(session('message_error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="message_success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card-container" id="searchResults">
        @foreach ($restaurants as $restaurant)
            <div class="restaurant-card">
                <img class="restaurant-image" src="{{ $restaurant->image }}" alt="{{ $restaurant->name }} Image">
                <div class="card-body">
                    <h3 class="card-title">{{ $restaurant->name }}</h3>
                    <div class="info-container">
                        <div class="restaurant-rating">
                            <?php $foundRating = false; ?>
                            @foreach ($averageRatings as $averageRating)
                                    @if ($averageRating->restaurant_id == $restaurant->id)                         
                                <span class="num">評価: </span>
                                <span class="rate" style="--width: {{ ($averageRating->average_rating / 5) * 100 }}%;"></span>
                                <?php $foundRating = true; ?>
                                @break
                            @endif
                            @endforeach
                            @if (!$foundRating)
                                <span>評価: NoRating</span>
                            @endif
                        </div>
                        <div class="info-container_tag">
                            <p class="card-tagt">#{{ $restaurant->region }}</p>
                            <p class="card-tag">#{{ $restaurant->genre }}</p>
                        </div>
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
</div>