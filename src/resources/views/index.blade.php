<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="{{ asset('js/favorite-script.js') }}"></script>
</head>
<body class="container">

    <div class="grid">
        <header class="header">
            <div class="header-area">
                <div class="hamburger">
                    <!-- ハンバーガーメニューの線 -->
                    <span></span>
                    <span></span>
                    <span></span>
                    <!-- /ハンバーガーメニューの線 -->
                </div>
            <h1 class="header-ttl">Rese</h1>
            </div>
            <ul class="slide-menu">
                @guest
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('register')}}">Registration</a></li>
                    <li><a href="/login">Login</a></li>
                @else
                    <li><a href="/">Home</a></li>
                    <li class="header-nav-item"><a href="/logout">Logout</a></li>
                    <li><a href="/mypage">Mypage</a></li>
                @endguest
            </ul>

            <!-- Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                // ハンバーガーメニューのアイコンをクリックした時の処理
                document.querySelector('.hamburger').addEventListener('click', function() {
                // ハンバーガーメニューアイコンのクラスを切り替えて、×アイコンに変化させる
                this.classList.toggle('active');
                document.querySelector('.slide-menu').classList.toggle('active');
                });
            </script>
        </header>
        
        <div class="search-form">
            <form action="/" method="GET" class="search-form" id="searchForm" onkeydown="if (event.keyCode === 13) { event.preventDefault(); document.getElementById('searchForm').submit(); }">
                <div class="search-form__outer-frame">
                    <select name="area" class="area">
                        <option value="">All area</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area }}" {{ request('area') == $area ? 'selected' : '' }}>{{ $area }}</option>
                        @endforeach
                    </select>
                    <select name="genre" class="genre">
                        <option value="">All genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                        @endforeach
                    </select>
                    <div class="search-icon" onclick="document.getElementById('searchInput').focus()">
                        <i class="fas fa-search" style="opacity: 0.1;"></i>
                    </div>
                    <input type="text" name="name" id="searchInput" class="name" placeholder="Search..." value="{{ request('name') }}">
                </div>
            </form>

        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card-container">
        @foreach ($restaurants as $restaurant)
        <div class="restaurant-card">
            <img class="restaurant-image" src="{{ $restaurant->image }}" alt="{{ $restaurant->name }} Image">
            <div class="card-body">
                <h3 class="card-title">{{ $restaurant->name }}</h3>
                <div class="card-text-container">
                    <p class="card-text">#{{ $restaurant->region }}</p>
                    <p class="card-text">#{{ $restaurant->genre }}</p>
                </div>
                <div class="btn-container">
                    <a href="/detail/{{ $restaurant->id }}" class="btn btn-detail">詳しく見る</a>
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
</body>
</html>        