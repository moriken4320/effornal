<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RoomUserCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 自分のルーム以外に入場しようとしたらルートにリダイレクトする
        if (! $request->room->roomUserCheck(Auth::user())) {
            return redirect('/');
        }

        return $next($request);
    }
}
