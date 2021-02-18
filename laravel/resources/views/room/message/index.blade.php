@extends('layouts.app')

@section('title', 'メッセージ / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">' . $opponent_user_name . '</span>'])

@section('content')
{{-- ルームを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto">
  @foreach ($room_messages as $message)
  {{-- @include('common.user_card') --}}
  @if ($message->user == Auth::user())
    <div class="d-flex flex-column align-items-end">
      <p>{{ $message->message }}</p>
      <p>{{ $message->created_at->format('Y-m-d H:i') }}</p>
    </div>
  @else
    <div class="d-flex flex-column align-items-start">
      @if ($message->user->image)
      {{-- base64という形式の画像データを表示する --}}
      <img class="relation-user-image" src="data:image/png;base64,{{ $message->user->image }}" alt="avatar" />
      @else
      <img class="relation-user-image" src="{{ asset('/images/blank_profile.png') }}" alt="avatar" />
      @endif
      <p>{{ $message->user->name }}</p>
      <p>{{ $message->message }}</p>
      <p>{{ $message->created_at->format('Y-m-d H:i') }}</p>
    </div>
  @endif
  <hr>
  @endforeach
</div>
@endsection