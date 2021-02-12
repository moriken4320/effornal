@extends('layouts.app')

@section('title', 'ログイン / Effornal')

@section('content')

<body style="background-color: rgb(0, 63, 0);">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <a class="navbar-brand font-weight-bold shadow-none app-logo" href="/">Effornal</a>
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <h2 class="h3 card-title text-center mt-2 font-weight-bold">ログイン</h2>

                        @include('common.errors')

                        <div class="card-text">
                            <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="md-form">
                                    <label for="email">メールアドレス</label>
                                    <input class="form-control" type="text" id="email" name="email" required
                                        value="{{ old('email') }}">
                                </div>

                                <div class="md-form">
                                    <label for="password">パスワード</label>
                                    <input class="form-control" type="password" id="password" name="password" required>
                                </div>

                                {{-- <div class="text-left">
                                    <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた</a>
                                </div> --}}

                                <button class="btn btn-block shadow-none text-white bg-primary mt-3"
                                    type="submit">ログイン</button>
                            </form>

                            {{-- Googleでログイン --}}
                            <a href="{{ route('socialOAuth', ['provider'=>'google']) }}"
                                class="btn btn-block btn-danger shadow-none mt-2 google">
                                <i class="fab fa-google mr-1"></i>Googleでログイン
                            </a>

                            {{-- ユーザー新規登録に遷移するボタン --}}
                            <div class="mt-3">
                                <a href="{{ route('register') }}" class="card-text">ユーザー登録はこちら</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


@endsection