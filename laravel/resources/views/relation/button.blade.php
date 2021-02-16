<form method="POST">
  {{ csrf_field() }}

  @if (Auth::user()->friendCheck($user))

  <input type="hidden" name="_method" value="DELETE">
  <button type="submit" class="btn btn-primary relation-btn" formaction="{{ route('relations.unFollow', ['user'=>$user]) }}"><i class="fas fa-handshake active"></i>フレンド中</button>

  @elseif (Auth::user()->throwerCheck($user))

  <input type="hidden" name="_method" value="PUT">
  <button type="submit" class="btn btn-outline-primary relation-btn" formaction="{{ route('relations.follow', ['user'=>$user]) }}"><i class="fas fa-handshake"></i>フレンドに追加</button>

  @elseif (Auth::user()->receiverCheck($user))

  <input type="hidden" name="_method" value="DELETE">
  <button type="submit" class="btn btn-primary relation-btn" formaction="{{ route('relations.unFollow', ['user'=>$user]) }}"><i class="fas fa-handshake active"></i>フレンド申請中</button>

  @else

  <input type="hidden" name="_method" value="PUT">
  <button type="submit" class="btn btn-outline-primary relation-btn" formaction="{{ route('relations.follow', ['user'=>$user]) }}"><i class="fas fa-handshake"></i>フレンド申請する</button>

  @endif

</form>