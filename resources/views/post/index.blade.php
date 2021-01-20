@extends('layouts.app')

@section('title', '投稿一覧 / Effornal')
    
@include('header')

@section('content')
<div class="container">
  <p>post.index</p>
  <a href="#" class="btn btn-primary">仮のボタンです</a>
  @guest
  ログインしていない
  @endguest
  @auth
  ログイン中
  @endauth
</div>
@endsection