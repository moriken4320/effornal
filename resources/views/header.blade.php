@section('header')

<nav class="navbar navbar-expand navbar-dark shadow-none">

  <div class="row no-gutters">
    <a class="navbar-brand font-weight-bold shadow-none" href="/">Effornal</a>
  </div>

  <ul class="navbar-nav ml-auto">
    @auth
    {{-- ドロップダウンで表示 --}}
    <li class="nav-item dropdown mr-2">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-user-circle mr-2"></i>
        {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        {{-- <button class="dropdown-item" type="button"
        onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}'">
        マイリスト
        </button> --}}
        {{-- <div class="dropdown-divider"></div> --}}
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