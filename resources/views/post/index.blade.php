@extends('layouts.app')

@include('header')

@section('content')
<p>post.index</p>
<a href="#" class="btn btn-primary">仮のボタンです</a>
@guest
    ログインしていない
@endguest
@auth
    ログイン中
@endauth
@endsection