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
    @if(Auth::check())
        <script src="{{ asset('js/favorite-script.js') }}"></script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @livewireStyles
</head>
<body class="container">

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

    <div class="search-form">
        <form action="/" method="GET" class="search-form" id="searchForm">
            <div class="search-form__outer-frame">
                <livewire:search />
                @livewireScripts
            </div>
        </form>
    </div>
</header>

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

<livewire:restaurant-list />
    
</body>
</html>        

<!-- メニューのアクション -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ハンバーガーメニューのアイコンをクリックした時の処理
    document.querySelector('.hamburger').addEventListener('click', function() {
    // ハンバーガーメニューアイコンのクラスを切り替えて、×アイコンに変化させる
    this.classList.toggle('active');
    document.querySelector('.slide-menu').classList.toggle('active');
    });
</script>
<!-- 「詳しく見る」 -->
<script>
function setReferringPage(page) {
    sessionStorage.setItem('referringPage', page);
}
</script>
