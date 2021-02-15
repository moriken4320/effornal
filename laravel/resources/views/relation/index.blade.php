@extends('layouts.app')

@section('title', 'フレンド / Effornal')

@include('header')

@section('content')
{{-- 全ての投稿データを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-8 col-sm-12 mx-auto relation-list">
  <ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown"
         href="#" role="button" aria-haspopup="true" aria-expanded="false">
         {{ $tab_name }}</a>
      <div class="dropdown-menu text-center" style="right:0;">
        <a class="dropdown-item" href="{{ route('friends.index') }}">フレンド一覧</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('receivers.index') }}">申請中のユーザー</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('throwers.index') }}">承認待ちのユーザー</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#!">ユーザー検索</a>
      </div>
    </li>
  </ul>
  @foreach ($relations as $relation)
  <div class="card">
    <div class="card-body">
      <div>
        @if ($relation->image)
        {{-- base64という形式の画像データを表示する --}}
        <img class="relation-user-image" src="data:image/png;base64,{{ $relation->image }}" alt="avatar" />
        @else
        <img class="relation-user-image" src="{{ asset('/images/blank_profile.png') }}" alt="avatar" />
        @endif
        <a class="relation-user-name" href="{{ route('users.show', ['user_id'=>$relation->id]) }}">{{ $relation->name }}</a>
      </div>
      <div>
        @include('relation.button', ['user'=>$relation])
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection