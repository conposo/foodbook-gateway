<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class SetUserLocation
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
        function setLatLong ($lat, $long)
        {
            Cookie::queue( Cookie::make( 'lat', $lat, time() + (86400 * 30), '/' ) );
            Cookie::queue( Cookie::make( 'long', $long, time() + (86400 * 30), '/' ) );
        }

        function resetLatLong ()
        {
            Cookie::queue( Cookie::make( 'lat', '', -(time() + (86400 * 30)), '/' ) );
            Cookie::queue( Cookie::make( 'long', '', -(time() + (86400 * 30)), '/' ) );
            $GLOBALS['set_to_auto'] = false;
        }

        function stateLocation ($state)
        {
            Cookie::queue( Cookie::make( 'location', $state, time() + (86400 * 30), '/' ) );
        }

        function setCity ($city)
        {
            Cookie::queue( Cookie::make( 'city', $city, time() + (86400 * 30), '/' ) );
            $GLOBALS['city'] = $city;
        }

        function setRange($range)
        {
            Cookie::queue( Cookie::make( 'range', $range, time() + (86400 * 30), '/' ) );
        }

        $GLOBALS['cities'] = [
            'Ruse',
            'Sofia',
            'Plovdiv',
            'Varna',
            'Burgas',
            'Синеморец',
            'Sinemorets',
            'Стара Загора',
            'Stara Zagora',
            'Велико Търново',
            'Veliko Tarnovo',
            'Севлиево',
            'Белоградчик',
            'Казанлък ',
            'Pernik',
            'Blagoevgrad',
            'Dobrich',
            'Montana',
            'Haskovo',
            'Pazardzhik',
            'Yambol',
            'Lovech',
            'Pleven',
            'Dupnitsa',
            'Gabrovo',
            'Vidin',
            'Sliven',
            'Dimitrovgrad',
            'Sandanski',
            'Shumen',
            'Silistra',
            'Velingrad',
            'Gotse Delchev',
            'Razgrad',
            'Kardzhali',
            'Targovishte',
            'Botevgrad',
            'Samokov',
            'Kazanlak',
            'Troyan',
            'Bansko',
            'Sozopol',
            'Smolyan',
            'Vratsa',
            'Kyustendil',
            'Balchik',
            'Kiten',
            'Pomorie',
            'Petrich',
            'Radomir',
            'Bankya',
            'Razlog',
            'Nessebar',
            'Svishtov',
            'Kavarna',
            'Slanchev Bryag',
            'Ravda',
        ];

        $GLOBALS['city'] = '';
        $GLOBALS['set_to_auto'] = false;
        $GLOBALS['range'] = null;
        if( isset($_GET['range']) )
        {
            $GLOBALS['range'] = $_GET['range'];
            setRange($GLOBALS['range']);
        }



        /**
         * 
         * Dynamic settings
         **/ 

        // Set City
        if( Cookie::get('city') )
        {
            $GLOBALS['city'] = ucfirst(Cookie::get('city'));
        }
        if( isset($_GET['city']) ) // set manual to that city
        {
            resetLatLong();
            stateLocation(0);
            switch( ucwords($_GET['city']) ) {
                case 'Ruse':
                    // setLatLong(43.835571,25.965655); detelinata
                    setLatLong(43.847814,25.949973); // center
                break;
                case 'Sofia':
                    setLatLong(42.697708,23.321868);
                break;
                case 'Plovdiv':
                    setLatLong(42.144841,24.745094);
                break;
                case 'Varna':
                    setLatLong(43.21249,27.909896);
                break;
                case 'Burgas':
                    setLatLong(42.496749,27.475294);
                break;
                case 'Blagoevgrad':
                    setLatLong(42.02033,23.092039);
                break;
                case 'Stara Zagora':
                    setLatLong(42.425777,25.634464);
                break;
                case 'Veliko Tarnovo':
                    setLatLong(43.079443,25.634763);
                break;
                case 'Gabrovo':
                    setLatLong(42.877664,25.318437);
                break;
                case 'Botevgrad':
                    setLatLong(42.907651,23.793366);
                break;
                case 'Pleven':
                    setLatLong(43.408174,24.619817);
                break;
                case 'Sinemorets':
                    setLatLong(42.060432,27.975739);
                break;
            }
            setCity( ucfirst($_GET['city']) );
            if( !$GLOBALS['range'] )
            {
                $GLOBALS['range'] = 3;
                setRange($GLOBALS['range']);
            }
        }

        // Set to AUTO
        if( isset($_GET['lat']) && isset($_GET['long']) )
        {
            $lat = $_GET['lat'];
            $long = $_GET['long'];

            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyD0dL6m-YQ85lUQ-CiKUE6UscmTG4EXHUo";
            $resp_json = file_get_contents($url);
            $resp = json_decode($resp_json, true);
            if( $resp ) {
                setCity( $resp['results'][8]['address_components'][0]['long_name'] );
                stateLocation(1);
                setLatLong ($lat, $long);
                $GLOBALS['set_to_auto'] = true;
                $GLOBALS['range'] = 3;
                setRange($GLOBALS['range']);
            }
        }

        // dd($GLOBALS['set_to_auto']);
        
        return $next($request);
    }
}
