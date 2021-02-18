@extends('layouts.app')

@section('title', 'メッセージ / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">' . $opponent_user_name . '</span>'])

@section('content')
{{-- ルームを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto">
  @if (count($room_messages) == 0)
    <div class="text-center mt-5">メッセージがありません</div>
  @endif
  @foreach ($room_messages as $message)
  {{-- @include('common.user_card') --}}
  @if ($message->user == Auth::user())
    <div class="message own">
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
    <div class="message other">
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

@endsection