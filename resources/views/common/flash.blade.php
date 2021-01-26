@if (session('flash_message'))
    <div class="flash_message bg-success text-center">
        {{ session('flash_message') }}
    </div>
@endif