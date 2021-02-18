@extends('layouts.app')

@section('title', 'メッセージ / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">' . $opponent_user_name . '</span>'])

@section('content')
{{-- ルームを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto" id="message" data-room-id='{{ $room->id }}'>
  @if (count($room_messages) == 0)
    <div class="text-center mt-5">メッセージがありません</div>
  @endif
  @foreach ($room_messages as $message)
  @if ($message->user == Auth::user())
    <div class="message own" data-message-id="{{ $message->id }}">
      <div class="message-top">
        <div class="message-content">
          {!! nl2br(e($message->message)) !!}
        </div>
      </div>
      <div class="message-bottom">
        <p class="message-time">{{ $message->created_at->format('Y-m-d H:i') }}</p>
      </div>
    </div>
  @else
    <div class="message other" data-message-id="{{ $message->id }}">
      <div class="message-top">
        @if ($message->user->image)
        {{-- base64という形式の画像データを表示する --}}
        <img class="message-user-image" src="data:image/png;base64,{{ $message->user->image }}" alt="avatar" />
        @else
        <img class="message-user-image" src="{{ asset('/images/blank_profile.png') }}" alt="avatar" />
        @endif
        <div class="message-content">{!! nl2br(e($message->message)) !!}</div>
      </div>
      <div class="message-bottom">
        <p class="message-time">{{ $message->created_at->format('Y-m-d H:i') }}</p>
      </div>
    </div>
  @endif
  @endforeach
</div>
  
{{-- 入力フォーム --}}
<div class="fixed-bottom py-3" style="background-color: gray">
  <form class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 input-group message-input align-items-center" id="form-bar" method="POST" action="{{ route('rooms.messages.create', ['room'=>$room]) }}">
  {{ csrf_field() }}
    <textarea name="message" rows="1" class="form-control" placeholder="メッセージを作成"></textarea>
    <div class="input-group-append">
      <button type="submit" class="btn btn-success send-btn">
        <i class="fas fa-paper-plane"></i>
        <span class="d-none d-sm-inline-block">送信</span>
      </button>
    </div>
  </form>
</div>
@endsection