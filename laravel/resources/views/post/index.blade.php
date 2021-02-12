@extends('layouts.app')

@section('title', '投稿一覧 / Effornal')

@include('header')

@section('content')
{{-- 全ての投稿データを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-8 col-sm-12 mx-auto post-list" id="post-list">
  @each('post.post_card', $posts, 'post')
</div>
@endsection