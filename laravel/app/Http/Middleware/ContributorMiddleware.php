<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class ContributorMiddleware
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
        // ログインユーザーが投稿者本人でない場合は投稿一覧にリダイレクト
        if (Auth::user()->id != $request->post->user_id) {
            return redirect('/');
        }

        return $next($request);
    }
}
