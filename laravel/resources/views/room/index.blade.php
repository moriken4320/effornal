@extends('layouts.app')

@section('title', 'DM選択 / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">メッセージ</span>'])

@section('content')
{{-- ルームを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto">
  @foreach ($rooms as $room)
  @include('common.user_card', ['user'=>$room->opponent_user])
  @endforeach
</div>
@endsection