@extends('layouts.app')

@section('title', 'いいねしたユーザー / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">いいね<i class="fas fa-heart" style="color: rgb(255, 97, 97); margin-right:10px;"></i></span> したユーザー'])

@section('content')
{{-- 該当ユーザーの投稿データを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto post-list">
  @foreach ($users as $user)
  @include('common.user_card')
  @endforeach
</div>
@endsection