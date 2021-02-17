@php
session()->regenerate();
if(url()->current() != URL::previous()){
  session(['previous_url'=>URL::previous()]);
}
@endphp

@section('middle-header')

{{-- ページ固定 --}}
<div class="col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto user-show-wrap">
  {{-- いいねしたユーザー --}}
  <div class="mx-auto user-show">
    <div class="user-show-left">
      <p class="user-show-left-user-name">{!! $page_name !!}</p>
    </div>
    {{-- 前のページに戻る --}}
    <a href="{{ session('previous_url') }}" class="previous-link">前に戻る</a>
  </div>
</div>

@endsection