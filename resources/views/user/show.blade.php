@extends('layouts.app')

@section('title', 'ユーザー詳細 / Effornal')

@include('header')
@include('user.user-show-fixed')

@section('content')
{{-- 該当ユーザーの投稿データを表示 --}}
<div class="container col-xl-7 col-lg-7 col-md-9 col-sm-12 mx-auto post-list" id="post-list">
  @each('post.post_card', $posts, 'post')
</div>
@endsection