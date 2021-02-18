<div class="card flex-fill">
  <div class="card-body user-card">
    <div class="d-flex align-items-center">
      @if ($user->image)
      {{-- base64という形式の画像データを表示する --}}
      <img class="relation-user-image" src="data:image/png;base64,{{ $user->image }}" alt="avatar" />
      @else
      <img class="relation-user-image" src="{{ asset('/images/blank_profile.png') }}" alt="avatar" />
      @endif
      <a class="relation-user-name" href="{{ route('users.show', ['user'=>$user]) }}">{{ $user->name }}</a>
    </div>
    <div>
      @if (request()->path() == 'ranking')
          <p>
            <span class="d-none d-sm-inline-block">合計時間： </span>
            {{ intdiv($user->sum_study_time, 60) }} h
            {{ $user->sum_study_time % 60 }} m
          </p>
      @elseif(request()->path() == 'rooms')
      {{-- メッセージルーム入場ボタン --}}
      <a href="{{ route('rooms.messages.index', ['room'=>$room]) }}" class="btn btn-primary px-3">
        <i class="fas fa-envelope"></i>
        <span class="d-none d-sm-inline-block">メッセージを開始</span>
      </a>
      @else
      @include('relation.button', ['user'=>$user])
      @endif
    </div>
  </div>
</div>