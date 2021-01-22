@php
if(isset($post))
{
  $study_time_hour = intdiv($post->study_time, 60);
  $study_time_min = $post->study_time % 60;
}else{
  $study_time_hour = 0;
  $study_time_min = 0;
}
@endphp

{{ csrf_field() }}
<div class="md-form">
  <label for="subject-title">科目名</label>
  <input type="text" name="name" id="subject-title" class="form-control" required value="{{ $post->subject->name ?? old('name') }}">
</div>

<div class="md-form">
  <p>勉強時間</p>
  {{  Form::select('study_time_hour', ['hour'=>range(0,23)], $study_time_hour ?? old('study_time_hour'))  }}
  {{  Form::select('study_time_min', ['min'=>range(0,59)], $study_time_min ?? old('study_time_min'))  }}
</div>

<div class="form-group">
  <textarea name="text" class="form-control" row="16" placeholder="詳細">{{ $post->text ?? old('text') }}</textarea>
</div>