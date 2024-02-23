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
        <li><a href="">Login</a></li>
    @else
        <li><a href="/">Home</a></li>
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