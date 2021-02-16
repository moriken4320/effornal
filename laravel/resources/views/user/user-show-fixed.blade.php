@section('user-show-fixed')

{{-- ページ固定 --}}
<div class="col-xl-5 col-lg-7 col-md-10 col-sm-12 mx-auto user-show-wrap relation-list">
  {{-- 〇〇さんのページ --}}
  <div class="mx-auto user-show">
    <div class="user-show-left">
      @if ($user->image)
      {{-- base64という形式の画像データを表示する --}}
      <img class="user-show-left-user-icon" src="data:image/png;base64,{{ $user->image }}" />
      @else
      <img class="user-show-left-user-icon" src="{{ asset('/images/blank_profile.png') }}" />
      @endif
      <p class="user-show-left-user-name"><span class="font-weight-bold">{{ $user->name }}</span><span>さんのページ</span></p>
    </div>
    {{-- ユーザー編集画面に遷移するボタン --}}
    @if (Auth::check())
      @if ($user->id == Auth::user()->id)
      <div class="user-show-right">
        <a href="{{ route('users.edit') }}">
          <i class="fas fa-cog user-show-right-user-config" id="modal_btn"></i>
        </a>
      </div>
      @else
      @include('relation.button', ['user'=>$user])
      @endif
    @endif
  </div>
  {{-- 勉強時間関連の情報欄 --}}
  <div class="time-sum-wrap">
    <div class="dropdown text-center alert alert-primary">
      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        class=" dropdown-toggle waves-effect waves-light">
        <p>合計勉強時間： <strong>{{ intdiv($study_data['sum_study_time'], 60) }}</strong> h
          <strong>{{ $study_data['sum_study_time'] % 60 }}</strong> m</p>
        {{-- <p>1日の最大勉強時間： <strong>{{ intdiv($study_data['max_study_time'], 60) }}</strong> h
        <strong>{{ $study_data['max_study_time'] % 60 }}</strong> m</p> --}}
      </a>
      {{-- dropdown --}}
      <div class="dropdown-menu shadow">
        @if (count($study_data['subjects']) <= 0)
        <div class="d-flex justify-content-between px-4">
          <p>現在、勉強した科目はありません。</p>
        </div>
        @else
        @foreach ($study_data['subjects'] as $subject)
        <div class="d-flex justify-content-between px-4">
          <p>{{ $subject['name'] }}</p>
          <p>{{ intdiv($subject['sum_study_time'], 60) }}h {{ $subject['sum_study_time'] % 60 }}m</p>
        </div>
          @if (!$loop->last)
          <div class="dropdown-divider"></div>
          @endif
        @endforeach
        @endif
      </div>
    </div>
  </div>
  {{-- マイページの場合プルダウンメニュー表示 --}}
  @if (Auth::check() && $user->id == Auth::user()->id)
  <ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown"
      href="#" role="button" aria-haspopup="true" aria-expanded="false">
      {{ $tab_name }}</a>
      <div class="dropdown-menu text-center" style="right:0;">
        <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">マイ投稿</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('users.likedPosts') }}">いいねした投稿</a>
      </div>
    </li>
  </ul>
  @endif
</div>

@endsection