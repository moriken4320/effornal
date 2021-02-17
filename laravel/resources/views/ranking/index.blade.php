@extends('layouts.app')

@section('title', 'ランキング / Effornal')

@include('header')
@include('common.middle_header', ['page_name'=>'<span class="font-weight-bold"><i class="fas fa-crown" style="color: #fb3; margin-right:10px;"></i>勉強時間ランキング</span>'])

@section('content')
{{-- ランキングデータを表示 --}}
<div class="container col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto relation-list">
  @foreach ($users as $user)
  @include('ranking.list')
  @endforeach
</div>
@endsection