<div id="menu" class="menu">
    <a href="{{ route('root') }}" class="menu__item">Home</a>
    @if (Auth::check())
        @if (Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}" class="menu__item">Dashboard</a>
            <form class="menu__item" name="admin-logout" action="{{ route('admin-owner.logout') }}" method="POST">
                @csrf
                <a class="menu__item" onclick="document.forms['admin-logout'].submit();">Logout</a>
            </form>
        @elseif (Auth::user()->hasRole('shop_owner'))
            <a href="{{ route('owner.dashboard') }}" class="menu__item">Dashboard</a>
            <form class="menu__item" name="owner-logout" action="{{ route('admin-owner.logout') }}" method="POST">
                @csrf
                <a class="menu__item" onclick="document.forms['owner-logout'].submit();">Logout</a>
            </form>
        @else
		<form name="logout" action="{{ route('logout') }}" method="POST">
			@csrf
			<a class="menu__item" href="javascript:void(0);" onclick="document.forms['logout'].submit();">Logout</a>
		</form>
            <a href="{{ route('mypage') }}" class="menu__item">Mypage</a>
        @endif
    @else
        <a href="{{ route('register') }}" class="menu__item">Registration</a>
        <a href="{{ route('login') }}" class="menu__item">Login</a>
    @endif
</div>
