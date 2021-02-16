@extends('layouts.app')

@section('title', '投稿詳細 / Effornal')

@include('header')

@section('content')
{{-- 全ての投稿データを表示 --}}
<div class="container col-xl-7 col-lg-7 col-md-10 col-sm-12 mx-auto post-list" id="post-list">
  @include('post.post_card')
</div>
@endsection