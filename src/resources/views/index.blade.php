<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <li><a href="">Home</a></li>
                    <li><a href="{{ route('register')}}">Registration</a></li>
                    <li><a href="">Login</a></li>
                @else
                    <li><a href="">Home</a></li>
                    <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    <li><a href="">Mypage</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
            <!-- 検索フォーム -->
            <div class="search-form__item">
                <input type="text" class="area" placeholder="エリア検索">
                <input type="text" class="genre" placeholder="ジャンル検索">
                <input type="text" class="name" placeholder="店名検索">
            </div>
        </div>
    </div>

        <div class="card-container">
            <!-- 飲食店カード -->
            <div class="restaurant-card">
                <img src="" alt="Restaurant Image">
                <div class="card-body">
                    <h5 class="card-title">飲食店名</h5>
                    <p class="card-text">都道府県名 | ジャンル</p>
                    <a href="/detail/{shop_id}" class="btn btn-primary">詳しく見る</a>
                    <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
                </div>
            </div>

        <div class="restaurant-card">
            <img src="" alt="Restaurant Image">
            <div class="card-body">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <!-- お気に入りボタン -->
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
        </div>



        <div class="restaurant-card">
            <img src="" alt="Restaurant Image">
            <div class="card-body">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <!-- お気に入りボタン -->
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
        </div>



        <div class="restaurant-card">
            <img src="" alt="Restaurant Image">
            <div class="card-body">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <!-- お気に入りボタン -->
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
        </div>

        <div class="restaurant-card">
            <img src="" alt="Restaurant Image">
            <div class="card-body">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <!-- お気に入りボタン -->
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
        </div>

        <div class="restaurant-card">
            <img src="" alt="Restaurant Image">
            <div class="card-body">
                <h5 class="card-title">飲食店名</h5>
                <p class="card-text">都道府県名 | ジャンル</p>
                <a href="#" class="btn btn-primary">詳しく見る</a>
                <!-- お気に入りボタン -->
                <button class="btn btn-outline-danger favorite-btn"><i class="fas fa-heart"></i></button>
            </div>
        </div>
    </div>



    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // お気に入りボタンのクリックイベント
        document.querySelectorAll('.favorite-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                btn.classList.toggle('active');
            });
        });
    </script>
</body>
</html>