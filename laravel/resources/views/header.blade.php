@section('header')

<nav class="navbar navbar-expand navbar-dark d-flex justify-content-between">

  <div class="row no-gutters">
    <a class="navbar-brand font-weight-bold shadow-none app-logo" href="/">Effornal</a>
  </div>

  {{-- 検索フォーム --}}
  @if (request()->path() == '/' || preg_match('/users\/\d+/', request()->path()) || request()->path() == 'users/likes_posts' || request()->path() == 'post_search')
  <div>
    <form method="GET" action="{{ route('postSearch') }}" class="search-form form-inline d-none d-sm-flex">
      <input name="post_search" type="search" placeholder="科目名で投稿を検索" value="{{ isset($post_search) ? $post_search : '' }}" class="form-control">
      <button type="submit" class="btn btn-primary header-btn"><i class="fas fa-search"></i></button>
    </form>
  </div>
  @endif

  <ul class="navbar-nav align-items-center">

    {{-- ランキングボタン --}}
    <a href="{{ route('ranking') }}" class="btn btn-warning header-btn">
      <i class="fas fa-crown"></i>
      <p class="d-none d-lg-block">ランキング</p>
    </a>

    {{-- ログアウト中に表示 --}}
    @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
    @endguest

    {{-- ログイン中に表示 --}}
    @auth
      {{-- 投稿作成ボタン --}}
      <a class="btn btn-success header-btn" href="{{ route('posts.new') }}">
        <i class="fas fa-external-link-alt"></i>
        <p class="d-none d-md-block">投稿する</p>
      </a>

      {{-- ユーザーアイコン --}}
      <li class="nav-item dropdown mr-2">
        <div class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if (Auth::user()->image)
          {{-- base64という形式の画像データを表示する --}}
          <img class="header-user-icon" src="data:image/png;base64,{{ Auth::user()->image }}" />
          @else
          <img class="header-user-icon" src="{{ asset('/images/blank_profile.png') }}"/>
          @endif
        </div>
        {{-- ドロップダウンで表示 --}}
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button"
          onclick="location.href='{{ route('users.show', ['user' => Auth::user()]) }}'">
          マイページ
          </button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" type="button"
          onclick="location.href='{{ route('friends.index') }}'">
          フレンド
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