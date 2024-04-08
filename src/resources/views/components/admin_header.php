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
    @if ( Auth::check() )
        @if( 0 == Auth::user()->role )
            <li><a href="">店舗代表者一覧</a></li>
            <li><a href="">店舗一覧</a></li>
            <li><a href=""></a></li>
        @endif
        @if( 1 == Auth::user()->role )
            <li><a href="">予約情報確認</a></li>
            <li class="header-nav-item"><a href="">店舗情報編集</a></li>
            <li><a href="">店舗情報作成</a></li>
        @endif
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <li><a href="">ログアウト</a></li>
        </form>
    @else
        <!-- ログイン -->
    @endif
  </ul>  

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // ハンバーガーメニューのアイコンをクリックした時の処理
    document.querySelector('.hamburger').addEventListener('click', function() {
      this.classList.toggle('active');
      document.querySelector('.slide-menu').classList.toggle('active');
    });
  </script>

</header>