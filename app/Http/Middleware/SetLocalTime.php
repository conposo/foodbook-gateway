<?php

namespace App\Http\Middleware;

use Closure;

class SetLocalTime
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
        setlocale(LC_TIME, "bg_BG.UTF-8");

        // dd( strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false );
        if( strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false ) {
            setlocale(LC_TIME, "bg_BG.UTF-8");
        }
        else
        {
            setlocale(LC_TIME, "bg_BG");
        }
        
        return $next($request);
    }
}
