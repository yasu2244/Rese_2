<header>
  <div class="header align-items-center flex">
    <x-hamburger-menu />
    <div class="search-container">
      @if(request()->path() == '/' || request()->path() == 'search')
        <x-sort />
        <x-search />
      @endif
    </div>
  </div>
  @if (session('fs_msg'))
    <div class="flash_message">
      {{ session('fs_msg') }}
    </div>
  @endif

  <x-drowmenu />
</header>