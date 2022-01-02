<?php

namespace App\Http\Middleware;

use Closure;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class SetDate
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

        if( isset($_GET['date']) )
        {
            $date = date( "Y-m-d", strtotime($_GET['date']) );
            Cookie::queue( Cookie::make( 'date', $date, time() + (86400 * 30), '/' ) );
        }
        else if( $request->cookie('date') === null )
        {
            $date = date("Y-m-d");
            Cookie::queue( Cookie::make( 'date', $date, time() + (86400 * 30), '/' ) );
        }
        else
        {
            if( !$request->cookie('date') )
            {
                $date = date("Y-m-d");
            }
            else
            {
                $date = $request->cookie('date');
            }
        }
        // setlocale(LC_ALL, 'bg_BG.UTF-8');
        $GLOBALS['date'] = $date;
        $GLOBALS['tomorrow'] = new \DateTime('tomorrow');
        $GLOBALS['yesterday'] = date('Y-m-d', strtotime('yesterday'));
        $GLOBALS['today'] = date('Y-m-d', strtotime('today'));
        $GLOBALS['today_formatted'] = strftime("%A", strtotime('today'));
        $GLOBALS['date_formatted'] = strftime("%A %d %B", strtotime($date));
        // dd($GLOBALS['date_formatted'], \App::getLocale());

        $_date = new \DateTime($date);
        $day = $_date->format("d");
        $week = $_date->format("W");
        $month = $_date->format("m");
        $year = $_date->format("Y");
        $day_formatted = strftime("%A", strtotime($date));
        $month_formatted = strftime("%B", strtotime($date));
        // echo "The week number is: $week and the month is: $month";

        $GLOBALS['day'] = $day;
        $GLOBALS['week'] = $week;
        $GLOBALS['month'] = $month;
        $GLOBALS['year'] = $year;
        $GLOBALS['day_formatted'] = $day_formatted;
        $GLOBALS['month_formatted'] = $month_formatted;


        $thisYear = $GLOBALS['year'];
        $weekNum = $GLOBALS['week'];

        $GLOBALS['monday'] = date('d', strtotime("$thisYear-W$weekNum"));
        $GLOBALS['tuesday'] = date('d', strtotime("$thisYear-W$weekNum-2"));
        $GLOBALS['wednesday'] = date('d', strtotime("$thisYear-W$weekNum-3"));
        $GLOBALS['thursday'] = date('d', strtotime("$thisYear-W$weekNum-4"));
        $GLOBALS['friday'] = date('d', strtotime("$thisYear-W$weekNum-5"));
        $GLOBALS['saturday'] = date('d', strtotime("$thisYear-W$weekNum-6"));
        $GLOBALS['sunday'] = date('d', strtotime("$thisYear-W$weekNum-7"));
        $GLOBALS['week_start'] = date('Y-m-d', strtotime("$thisYear-W$weekNum"));
        $GLOBALS['week_end'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-7"));

        $GLOBALS['month_start'] = date('Y-m-01', strtotime($date));
        $GLOBALS['month_end'] = date('Y-m-t', strtotime($date));
        
        // dd($GLOBALS['month_start'], $GLOBALS['month_end']);
        return $next($request);
    }
}
