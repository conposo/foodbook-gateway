<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function combinePriceParts($price)
    {
        $price_with_comma = explode(",", $price);
        $price_with_dot = explode(".", $price);
        if ( count($price_with_dot) > count($price_with_comma) ) :
            $price = $price_with_dot;
        else:
            $price = $price_with_comma;
        endif;
        if(isset($price[1]))
        {
            if(strlen($price[1]) == 1)
            {
                $_price1 = ",{$price[1]}0";
            }
            else $_price1 = ",{$price[1]}";
        }
        else $_price1 = ',00';
        return $price[0].$_price1;
    }
}
