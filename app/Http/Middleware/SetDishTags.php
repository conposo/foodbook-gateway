<?php

namespace App\Http\Middleware;

use Closure;

class SetDishTags
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

        function types($_types)
        {
            $types = [
                'cold' => [
                    'slug' => 'cold',
                    'en_name' => 'cold',
                    'bg_name' => 'студени',
                ],
                'hot' => [
                    'slug' => 'hot',
                    'en_name' => 'hot',
                    'bg_name' => 'топли',
                ],
                'meat' => [
                    'slug' => 'meat',
                    'en_name' => 'meat',
                    'bg_name' => 'месни',
                ],
                'meatless' => [
                    'slug' => 'meatless',
                    'en_name' => 'meatless',
                    'bg_name' => 'безмесни',
                ],
                'veggie' => [
                    'slug' => 'veggie',
                    'en_name' => 'veggie',
                    'bg_name' => 'зеленчукови',
                ],
                'vegan' => [
                    'slug' => 'vegan',
                    'en_name' => 'vegan',
                    'bg_name' => 'вегански',
                ],
                'mushroom' => [
                    'slug' => 'mushroom',
                    'en_name' => 'mushroom',
                    'bg_name' => 'гъбени',
                ],
                'chicken' => [
                    'slug' => 'chicken',
                    'en_name' => 'chicken',
                    'bg_name' => 'пилешки',
                ],
                'poultry' => [
                    'slug' => 'poultry',
                    'en_name' => 'poultry',
                    'bg_name' => 'птиче месо',
                ],
                'fishy' => [
                    'slug' => 'fishy',
                    'en_name' => 'fishy',
                    'bg_name' => 'рибени',
                ],
                'pork' => [
                    'slug' => 'pork',
                    'en_name' => 'pork',
                    'bg_name' => 'свинско',
                ],
                'cream' => [
                    'slug' => 'cream',
                    'en_name' => 'cream',
                    'bg_name' => 'крем',
                ],
                'clear' => [
                    'slug' => 'clear',
                    'en_name' => 'clear',
                    'bg_name' => 'бистри',
                ],
                'nonclear' => [
                    'slug' => 'nonclear',
                    'en_name' => 'nonclear',
                    'bg_name' => 'небистри',
                ],
                // bread
                'loafs' => [
                    'slug' => 'loafs',
                    'en_name' => 'loafs',
                    'bg_name' => 'питки',
                ],
                'kifleni' => [
                    'slug' => 'kifleni',
                    'en_name' => 'kifleni',
                    'bg_name' => 'кифлени',
                ],
                'kozunacheni' => [
                    'slug' => 'kozunacheni',
                    'en_name' => 'kozunacheni',
                    'bg_name' => 'козуначени',
                ],
                'banichni' => [
                    'slug' => 'banichni',
                    'en_name' => 'banichni',
                    'bg_name' => 'банични',
                ],
                'masleni' => [
                    'slug' => 'masleni',
                    'en_name' => 'masleni',
                    'bg_name' => 'маслени',
                ],
                'mnogolistni' => [
                    'slug' => 'mnogolistni',
                    'en_name' => 'mnogolistni',
                    'bg_name' => 'многолистни',
                ],
                'dried' => [
                    'slug' => 'dried',
                    'en_name' => 'dried',
                    'bg_name' => 'сухи',
                ],
                // cold desserts
                'egg-dairy' => [
                    'slug' => 'egg-dairy',
                    'en_name' => 'egg-dairy',
                    'bg_name' => 'яйчно млечни',
                ],
                'fruity' => [
                    'slug' => 'fruity',
                    'en_name' => 'fruity',
                    'bg_name' => 'плодови',
                ],
                'jelly' => [
                    'slug' => 'jelly',
                    'en_name' => 'jelly',
                    'bg_name' => 'желирани',
                ],
                'acid' => [
                    'slug' => 'acid',
                    'en_name' => 'acid',
                    'bg_name' => 'кисели',
                ],
                'gelatin' => [
                    'slug' => 'gelatin',
                    'en_name' => 'gelatin',
                    'bg_name' => 'желатинови',
                ],
                // hot desserts
                'souffle' => [
                    'slug' => 'souffle',
                    'en_name' => 'souffle',
                    'bg_name' => 'суфлети',
                ],
                'puddings' => [
                    'slug' => 'puddings',
                    'en_name' => 'puddings',
                    'bg_name' => 'пудинги',
                ],
                'omelettes' => [
                    'slug' => 'omelettes',
                    'en_name' => 'omelettes',
                    'bg_name' => 'омлети',
                ],
                'others' => [
                    'slug' => 'others',
                    'en_name' => 'others',
                    'bg_name' => 'други',
                ],
            ];
            $return_val = [];
            foreach($_types as $_type)
            {
                $return_val[$_type] = $types[$_type];
            }
            return $return_val;
        }

        $GLOBALS['dish_types'] = [
            'soups' => types(['cold', 'hot', 'meat', 'meatless', 'veggie', 'cream', 'clear', 'nonclear']),
            'salads' => types(['veggie', 'meat', 'meatless']),
            'starters' => types(['cold', 'hot', 'meat', 'meatless', 'mushroom', 'fishy', 'chicken']),
            'garnish' => types(['cold', 'hot', 'meat', 'meatless']),
            'maindishes' => types(['meat', 'meatless', 'mushroom', 'fishy', 'chicken', 'pork']),
            'pizza' => types(['meat', 'meatless']),
            'pasta' => types(['meat', 'meatless']),
            'bread' => types(['loafs', 'kifleni', 'kozunacheni', 'banichni', 'masleni', 'mnogolistni', 'dried']),
            'desserts' => types(['others', 'cold', 'hot', 'egg-dairy', 'fruity', 'jelly', 'acid', 'gelatin', 'souffle', 'puddings', 'omelettes',]),
        ];

        $GLOBALS['dish_default_types'] = [
            'soups' => types(['meat', 'meatless', 'hot']),
            'salads' => types(['meat', 'meatless']),
            'starters' => types(['meat', 'meatless']),
            'garnish' => types(['cold', 'hot']),
            'maindishes' => types(['meat', 'meatless']),
            'pizza' => types(['meat', 'meatless']),
            'pasta' => types(['meat', 'meatless']),
            'bread' => types(['loafs', 'kifleni']),
            'desserts' => types(['others']),
        ];

        return $next($request);
    }
}
