@extends('layouts.app')

@section('title', '新しいメッセージ / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold">新しいメッセージ</span>'])

@section('content')
{{-- フレンドを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto">
  @foreach ($relations as $relation)
  @include('common.user_card', ['user'=>$relation])
  @endforeach
  <div class="text-center mt-5">※メッセージはフレンドとのみ可能です。</div>
</div>
@endsection