<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetUser
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
        $GLOBALS['user_type'] = 'user';
        $GLOBALS['user_type_id'] = Auth::id();
        // dd($request->user(), $GLOBALS['user_type_id']);
        return $next($request);
    }
}
