@section('header')

<nav class="navbar navbar-expand navbar-dark shadow-none">

  <div class="row no-gutters">
    <a class="navbar-brand font-weight-bold shadow-none app-logo" href="/">Effornal</a>
  </div>

  <ul class="navbar-nav ml-auto">

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth
    {{-- ドロップダウンで表示 --}}
    <li class="nav-item dropdown mr-2">
      <div class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if (Auth::user()->image)
            {{-- base64という形式の画像データを表示する --}}
            <img class="header-user-icon" src="data:image/png;base64,{{ Auth::user()->image }}" />
        @else
            <img class="header-user-icon" src="{{ asset('/images/blank_profile.png') }}"/>
        @endif
      </div>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
        onclick="location.href='{{ route('users.show', ['user_id' => Auth::user()->id]) }}'">
        マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}" style="display: none;">
      {{ csrf_field() }}
    </form>
    {{-- /ドロップダウンで表示 --}}
    @endauth

  </ul>

</nav>

@endsection