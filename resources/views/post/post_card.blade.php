<div class="card">
  <div class="card-header">
    @if ($post->user->image)
    {{-- base64という形式の画像データを表示する --}}
    <img class="post-user-image" src="data:image/png;base64,{{ $post->user->image }}" alt="avatar" />
    @else
    <img class="post-user-image" src="{{ asset('/images/blank_profile.png') }}" />
    @endif
    <a class="post-user-name" href="{{ route('users.show', ['user_id'=>$post->user->id]) }}">{{ $post->user->name }}</a>

    @if( Auth::check() && Auth::user()->id == $post->user->id )
    {{-- dropdown --}}
    <div class="float-right ml-auto card-text">
      <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route('posts.edit', ['post_id'=>$post->id]) }}">
            <i class="fas fa-pen mr-1"></i>編集する
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
            <i class="fas fa-trash-alt mr-1"></i>削除する
          </a>
        </div>
      </div>
    </div>

    {{-- /modal --}}
    <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{ route('posts.destroy', ['post_id' => $post->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-body text-center">
              本当に削除してもよろしいですか？
            </div>
            <div class="modal-footer justify-content-between">
              <a class="btn btn-outline-grey shadow-none" data-dismiss="modal">キャンセル</a>
              <button type="submit" class="btn btn-danger shadow-none">削除する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endif

  </div>
  <div class="card-body">
    <p class="post-main">科目名： {{ $post->subject->name }}</p>
    <p class="post-main">勉強時間： {{ intdiv($post->study_time, 60) }}h {{ $post->study_time % 60 }}m</p>
    <p class="post-text">{{ $post->text }}</p>
  </div>
  <div class="card-footer">
    <div>
      <i class="fas fa-heart"></i>0
    </div>
    {{ $post->created_at }}
  </div>
</div>