@if (Auth::user()->friendCheck($user))
<a class="btn btn-primary relation-btn" href="/"><i class="fas fa-handshake active"></i>フレンド中</a>
@elseif (Auth::user()->throwerCheck($user))
<a class="btn btn-outline-primary relation-btn" href="/"><i class="fas fa-handshake"></i>フレンドに追加</a>
@elseif (Auth::user()->receiverCheck($user))
<a class="btn btn-primary relation-btn" href="/"><i class="fas fa-handshake active"></i>フレンド申請中</a>
@else
<a class="btn btn-outline-primary relation-btn" href="/"><i class="fas fa-handshake"></i>フレンド申請する</a>
@endif