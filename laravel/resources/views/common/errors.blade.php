@if (count($errors) > 0)
  <div class="card-text text-left alert alert-danger mt-3">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif