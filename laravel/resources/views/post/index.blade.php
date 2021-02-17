@extends('layouts.app')

@section('title', '投稿一覧 / Effornal')

@include('header')

@section('content')
{{-- 全ての投稿データを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto post-list" id="post-list">
  @if (count($posts) == 0)
    <div class="text-center mt-5">該当する投稿がありません</div>
  @else
    @if (isset($post_search))
    <div class="text-center mt-3">
      <hr>
      {{ count($posts) }}件の投稿が見つかりました。
      <hr>
    </div>
    @endif
    @each('post.post_card', $posts, 'post')
  @endif
</div>
@endsection