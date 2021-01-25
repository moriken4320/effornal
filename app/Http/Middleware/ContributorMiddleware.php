<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Auth;

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
        // リクエストのIDに該当する投稿が存在しない
        // または、
        // ログインユーザーが投稿者本人でない場合は投稿一覧にリダイレクト
        if(empty($request->post) || Auth::user()->id != $request->post->user_id)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
