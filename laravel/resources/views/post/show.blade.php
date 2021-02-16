@extends('layouts.app')

@section('title', '投稿詳細 / Effornal')

@include('header')

@section('content')
{{-- 投稿の詳細データを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto">
  @include('post.post_card')
  <ul class="list-group card mt-3 post-show">
    <li class="card-header text-white justify-content-center main-back-color">コメント</li>
    <li class="list-group-item">
      @if (Auth::check())
      {{-- コメント作成部分 --}}
      <form method="POST" action="{{ route('comment.create', ['post'=>$post]) }}">
        {{ csrf_field() }}
        <div class="form-group row mb-0">
          <div class="col-md-12 p-3 w-100 d-flex align-items-center">
            @if (Auth::user()->image)
            {{-- base64という形式の画像データを表示する --}}
            <img class="post-user-image" src="data:image/png;base64,{{ Auth::user()->image }}" alt="avatar" />
            @else
            <img class="post-user-image" src="{{ asset('/images/blank_profile.png') }}" />
            @endif
            <a href="{{ route('users.show', ['user_id'=>Auth::user()->id]) }}" class="post-user-name">{{ Auth::user()->name }}</a>
          </div>
          <div class="col-md-12">
            @include('common.errors')
            <textarea name="comment" rows="4" placeholder="コメントを入力してください。" class="form-control">{{ old('comment') }}</textarea>
          </div>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-12 text-right">
            <p class="mb-4 text-danger">250文字以内</p>
            <button type="submit" class="btn btn-success">コメントする</button>
          </div>
        </div>
      </form>
      @else
      <p class="mb-0 text-center"><a href="{{ route('login') }}">ログイン</a>してコメントしてみよう。</p>
      @endif
    </li>
    @if (count($comments) == 0)
    <li class="list-group-item">
      <p class="mb-0 text-muted text-center">コメントはまだありません。</p>
    </li>
    @else
    {{-- コメント一覧 --}}
    @foreach ($comments as $comment)
    <li class="list-group-item">
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          @if ($comment->user->image)
          {{-- base64という形式の画像データを表示する --}}
          <img class="post-user-image" src="data:image/png;base64,{{ $comment->user->image }}" alt="avatar" />
          @else
          <img class="post-user-image" src="{{ asset('/images/blank_profile.png') }}" />
          @endif
          <a class="post-user-name" href="{{ route('users.show', ['user_id'=>$comment->user->id]) }}">{{ $comment->user->name }}</a>
        </div>
        <p class="create-time">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
      </div>
      <div class="p-3">
        {!! nl2br(e($comment->comment)) !!}
      </div>
    </li>
    @endforeach
    @endif
  </ul>
</div>
@endsection