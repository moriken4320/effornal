@extends('layouts.app')

@section('title', 'ユーザー編集 / Effornal')
    
@include('header')

@section('content')
<div class="container">
  <p>user.edit</p>

  {{-- @if ($user->id == Auth::user()->id)
    <p>{{ $user->email }}</p>
  @endif --}}
</div>
@endsection