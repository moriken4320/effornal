@extends('layouts.app')

@section('title', '投稿一覧 / Effornal')
    
@include('header')

@section('content')
<div class="container">
  @foreach ($posts as $post)
      @include('post.post_card')
  @endforeach
</div>
@endsection