@extends('layouts.app')

@section('title', 'メッセージ / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">メッセージ</span>'])

@section('content')
{{-- ルームを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto" id="room">
  @foreach ($rooms as $room)
  @include('common.user_card', ['user'=>$room->opponent_user])
  @endforeach
</div>
<div class="fixed-bottom pb-3" style="background-color: white">
  <div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12">
    <a class="btn btn-success new-room-btn d-flex align-items-center justify-content-center" href="{{ route('rooms.new') }}">
      <i class="fas fa-plus d-sm-none" style="font-size: 20px"></i>
      <span class="d-none d-sm-inline-block">別のフレンドと新しくメッセージを開始する</span>
    </a>
  </div>
</div>
@endsection