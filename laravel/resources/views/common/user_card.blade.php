<div class="card">
  <div class="card-body user-card">
    <div>
      @if ($user->image)
      {{-- base64という形式の画像データを表示する --}}
      <img class="relation-user-image" src="data:image/png;base64,{{ $user->image }}" alt="avatar" />
      @else
      <img class="relation-user-image" src="{{ asset('/images/blank_profile.png') }}" alt="avatar" />
      @endif
      <a class="relation-user-name" href="{{ route('users.show', ['user_id'=>$user->id]) }}">{{ $user->name }}</a>
    </div>
    <div>
      @include('relation.button', ['user'=>$user])
    </div>
  </div>
</div>