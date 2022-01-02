<?php

namespace App\Http\Middleware;

use Closure;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class SetTime
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

        return $next($request);
    }
}
