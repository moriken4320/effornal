@section('user-show-fixed')

{{-- ページ固定 --}}
<div id="fixed-wrap" class="col-xl-5 col-lg-7 col-md-8 col-sm-12 mx-auto">
  {{-- 〇〇さんのページ --}}
  <div class="mx-auto user-show">
    <div class="user-show-left">
      @if ($user->image)
      {{-- base64という形式の画像データを表示する --}}
      <img class="user-show-left-user-icon" src="data:image/png;base64,{{ $user->image }}" />
      @else
      <img class="user-show-left-user-icon" src="{{ asset('/images/blank_profile.png') }}" />
      @endif
      <p class="user-show-left-user-name"><span class="font-weight-bold">{{ $user->name }}</span>さんのページ</p>
    </div>
    {{-- ユーザー編集画面に遷移するボタン --}}
    @if (Auth::check() && $user->id == Auth::user()->id)
    <div class="user-show-right">
      <a href="{{ route('users.edit') }}">
        <i class="fas fa-cog user-show-right-user-config" id="modal_btn"></i>
      </a>
    </div>
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
</div>

@endsection