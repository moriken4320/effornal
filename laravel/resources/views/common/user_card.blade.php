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
      @else
      @include('relation.button', ['user'=>$user])
      @endif
    </div>
  </div>
</div>