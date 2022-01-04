<?php

namespace App\Http\Middleware;

use Closure;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class SetMeal
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
        // dd( $request->cookie('meal') );
        $GLOBALS['meal'] = '';

        if( !$request->is('/') )
        {
            $uri_paths = explode('/', url()->current());
            $meal_slug = array_pop($uri_paths);

            if( $meal_slug == 'breakfast' || $meal_slug == 'lunch' || $meal_slug == 'dinner' )
            {
                if( $meal_slug != $request->cookie('meal') )
                {
                    $GLOBALS['meal'] = $meal_slug;
                    \Illuminate\Support\Facades\Cookie::queue( \Illuminate\Support\Facades\Cookie::make( 'meal', $meal_slug, time() + (86400 * 30), '/' ) );
                }
                else
                {
                    $GLOBALS['meal'] = Cookie::get( 'meal');
                }
            }
            else
            {
                $GLOBALS['meal'] = Cookie::get( 'meal');
            }

        }
        else if( $request->cookie('meal') )
        {
            $GLOBALS['meal'] = Cookie::get( 'meal');
        }

        $time = '05:00';

        // switch( Cookie::get( 'meal') )
        switch( $GLOBALS['meal'] )
        {
            case 'breakfast':
                $time = '05:00';
            break;
            case 'lunch':
                $time = '11:00';
            break;
            case 'dinner':
                $time = '17:00';
            break;
        }
        $GLOBALS['meal_time'] = $time;

        return $next($request);
    }
}
