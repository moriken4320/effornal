@extends('layouts.app')

@section('title', '投稿編集 / Effornal')
    
@include('header')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 mx-auto">
      <div class="card-mt-3">
        <div class="card-body pt-0">
          @include('common.errors')
          <div class="card-text">
            <form method="POST" action="{{ route('posts.update',['post_id'=>$post->id]) }}" onsubmit="return false;">
              @include('post.form')
              <button type="button" class="btn btn-block shadow-none text-white create-post-btn" onclick="submit();">更新</button>
            </from>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection