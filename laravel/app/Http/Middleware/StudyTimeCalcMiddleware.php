<?php

namespace App\Http\Middleware;

use Closure;

class StudyTimeCalcMiddleware
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
        $study_time = $request->study_time_hour * 60 + $request->study_time_min;
        $request->merge([
            'study_time'=> $study_time,
        ]);

        return $next($request);
    }
}
