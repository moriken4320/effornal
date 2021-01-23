@extends('layouts.app')

@section('title', 'ユーザー詳細 / Effornal')

@include('header')

@section('content')
<div class="container">
  <div class="mx-auto user-show">
    <div class="user-show-left">
      @if ($user->image)
      {{-- base64という形式の画像データを表示する --}}
      <img class="user-show-left-user-icon" src="data:image/png;base64,{{ $user->image }}" />
      @else
      <img class="user-show-left-user-icon" src="{{ asset('/images/blank_profile.png') }}" />
      @endif
      <p class="user-show-left-user-name"><span class="font-weight-bold">{{ $user->name }}</span>さんのページ</p>
    </div>
    {{-- ユーザー編集画面に遷移するボタン --}}
    @if (Auth::check() && $user->id == Auth::user()->id)
    <div class="user-show-right">
      <a href="{{ route('users.edit') }}">
        <i class="fas fa-cog user-show-right-user-config" id="modal_btn"></i>
      </a>
    </div>
    @endif
  </div>
  {{-- 勉強時間関連の情報欄 --}}
  <div class="mx-auto time-sum-wrap">
    <p>総勉強時間： {{ intdiv($study_data['sum_study_time'], 60) }}h {{ $study_data['sum_study_time'] % 60 }}m</p>
    <p>1日の最大勉強時間： {{ intdiv($study_data['max_study_time'], 60) }}h {{ $study_data['max_study_time'] % 60 }}m</p>
    <ul style="background-color: gray">
      @foreach ($study_data['subjects'] as $subject)
      <li>{{ $subject['name'] }}： {{ intdiv($subject['sum_study_time'], 60) }}h {{ $subject['sum_study_time'] % 60 }}m</li>
      @endforeach
    </ul>
  </div>
  {{-- 該当ユーザーの投稿データ --}}
  <div class="show-posts-list">
    @foreach ($posts as $post)
    @include('post.post_card')
    @endforeach
  </div>
</div>
@endsection