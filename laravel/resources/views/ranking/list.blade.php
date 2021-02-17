<div class="d-flex flex-row align-items-center">
  <div class="ranking">
    @if ($user->rank == 1)
    <i class="fas fa-crown ranking-icon-1"></i>
    @elseif($user->rank == 2)
    <i class="fas fa-crown ranking-icon-2"></i>
    @elseif($user->rank == 3)
    <i class="fas fa-crown ranking-icon-3"></i>
    @else
    <div class="ranking-icon-other"></div>
    @endif
    <span class="ranking-num">{{ $user->rank }}</span>
  </div>
  @include('common.user_card')
</div>