@php
if(isset($post))
{
  $subject_title = $post->subject->name;
  $study_time_hour = intdiv($post->study_time, 60);
  $study_time_min = $post->study_time % 60;
  $text = $post->text;
}else{
  $subject_title = '';
  $study_time_hour = 0;
  $study_time_min = 0;
  $text = '';
}
@endphp

{{ csrf_field() }}
<div class="md-form" id="subject-input">
  <label for="subject-title">科目名</label>
  <input type="text" name="name" id="subject-title" class="form-control" required value="{{ old('name') ?? $subject_title }}" autocomplete="off">
</div>

<div class="md-form study-time-wrap">
  <p>勉強時間</p>
  <p>
    {{  Form::select('study_time_hour', ['hour'=>range(0,23)], $study_time_hour ?? old('study_time_hour'))  }} h
  </p>
  <p>
    {{  Form::select('study_time_min', ['min'=>range(0,59)], $study_time_min ?? old('study_time_min'))  }} m
  </p>
</div>

<div class="form-group">
  <textarea name="text" class="form-control" row="16" placeholder="詳細">{{ old('text') ?? $text }}</textarea>
</div>