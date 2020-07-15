<?php

namespace App\Http\Middleware;

use Closure;

class AdmMiddleware
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
        if (\Auth::guest() || \Auth::user()->admin != 1) {
            return redirect("inicio");
        }
        return $next($request);
    }
}
