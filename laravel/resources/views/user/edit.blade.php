@extends('layouts.app')

@section('title', 'ユーザー編集 / Effornal')

@section('content')

<body style="background-color: rgb(0, 63, 0);">
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <a class="navbar-brand font-weight-bold shadow-none app-logo" href="/">Effornal</a>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2 font-weight-bold">ユーザー情報編集</h2>

            @include('common.errors')

            <div class="card-text">
              <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="user-image">
                  <label for="input-user-image">
                    @if ($user->image)
                    {{-- base64という形式の画像データを表示する --}}
                    <img class="user-image-photo" src="data:image/png;base64,{{ $user->image }}" alt="avatar" id="user-image" />
                    @else
                    <img class="user-image-photo" src="{{ asset('/images/blank_profile.png') }}" id="user-image" />
                    @endif
                    <div class="btn btn-success btn-sm" style="display: block">画像変更</div>
                  </label>
                  <input type="file" name="image" accept="image/jpeg,image/gif,image/png" class="hidden"
                    id="input-user-image" />
                </div>
                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control" type="text" id="name" name="name" required
                    value="{{ old('name', $user->name) }}" maxlength="8">
                </div>
                <button class="btn btn-block shadow-none text-white bg-primary mt-3" type="submit">更新</button>
              </form>

              <div class="mt-3">
                <a href="{{ route('users.show',['user_id'=>$user->id]) }}" class="card-text">マイページに戻る</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@endsection