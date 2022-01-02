<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use App\Services\DishService;
use App\Services\RestaurantService;

class StaticController extends Controller
{
    public $dishService;

    public function __construct(DishService $dishService, RestaurantService $restaurantService)
    {
        $this->dishService = $dishService;
        $this->restaurantService = $restaurantService;
    }

    public function category(Request $request, $category_name)
    {
        $tags = '';
        $data['user_data'] = collect([]);

        if($request->tags) $tags = implode(',', $request->tags);
        $user = Auth::user();

        if($user)
        {
            $user_data = $this->dishService->obtainByOwner('P', $user->id);
            if( json_decode($user_data, true) && isset(json_decode($user_data, true)['data']) )
            {
                $user_data = collect(json_decode($user_data, true)['data']);
                $data['user_data'] = $user_data->where('category', $category_name);
            }
        }

        $public_data = $this->dishService->obtainByCategory($category_name, $tags);
        $data['data'] = json_decode($public_data, true);
        $data['category_name'] = $category_name;
        $data['B_dishes'] = [];
        /**
         * To-Do
         * GET Restaurant Specialties dishes
         * GET User position
         * GET restaurants in the perimeter ?
         * get R menus
         * loop menus
         * get dishes
         * ...
         */

        // ini_set('memory_limit', '-1');
        // $radius = 3;
        // $radius = 0.89;
        $radius = \Cookie::get('range');
        $latlng = \Cookie::get('lat').'|'.\Cookie::get('long');
        // dd($latlng);
        // $latlng = '43.8405928|25.9445667'; // Ruse
        // $latlng = '42.6260076|23.3135213'; // Sofia Dalida
        // $latlng = '42.6964527,23.3241262'; // Sofia Center
        // $latlng = '42.6581647,23.2835205'; // Sofia CAYO

        // $latlng = str_replace(',', '|', $latlng);
        // dd($latlng);
        $restaurants = $this->restaurantService->obtainRestaurantsByLocation($latlng, $radius);

        // dd($restaurants);
        // Refactor !!!
        if( json_decode($restaurants) && isset(json_decode($restaurants)->data) )
        {
            $restaurants = collect(json_decode($restaurants)->data)->where('public_dishes');

            $restaurants_ids = collect($restaurants)->pluck('id');
            $menus = collect($restaurants)->pluck('menu', 'id');
            
            foreach( $restaurants_ids as $restaurant_id )
            {
                $_B_dishes = json_decode( $this->dishService->obtainByOwner('B', $restaurant_id) )->data;
                // var_dump( $_B_dishes );
                $_menu_dishes = collect($menus[$restaurant_id])->where('category_slug', $category_name);
                if( $_menu_dishes->isNotEmpty() ) :
                    $B_menu_dishes[] = $_menu_dishes->toArray();
                else: continue; endif;
                
                $B_dishes = collect($_B_dishes)->where('category', $category_name)->where('public', '1');
                if( $B_dishes->isNotEmpty() ) :
                    $Bdishes[] = $B_dishes->toArray();
                else: continue; endif;
            }
            if( isset($Bdishes) && isset($B_menu_dishes) )
            {
                $B_menu_dishes = array_merge(...$B_menu_dishes);
                $Bdishes = array_merge(...$Bdishes);
    
                foreach( $Bdishes as $B_dish )
                {
                    if( $B_dish_in_menu = collect($B_menu_dishes)->where('dish_id', $B_dish->id)->where('dish_name', $B_dish->bg_name)->first() )
                    {
                        $B_dishes_in_menu[] = $B_dish_in_menu;
                    }
                    // dd($B_dish->id, $B_dish_in_menu);
                    // dd($B_dish_in_menu);
                }
                if( isset($B_dishes_in_menu) )
                {
                    $B_dishes_in_menu_ids = collect($B_dishes_in_menu)->pluck('dish_id')->toArray();
                    
                    foreach($B_dishes_in_menu_ids as $id)
                    {
                        $Bdishes = collect($Bdishes);
                        $final_result_with_B_dishes[] = (array) $Bdishes->where('id', $id)->first();
                    }
    
                    if( isset($final_result_with_B_dishes) )
                    {
                        $data['B_dishes'] = $final_result_with_B_dishes;
                    }
    
                    // dd( $final_result_with_B_dishes );
                }
            }
        }

        // dd( $data );
        return view('static.category.single.index', $data);
    }

    public function dish($slug)
    {
        $data = [];
        $exploded_slug = explode('-', $slug);
        $last_part = array_pop($exploded_slug);
        if( !is_numeric($slug) && is_numeric($last_part) )
        {
            $dish = $this->dishService->obtainByTypeAndId('P', $slug);
            $data['data'] = collect(json_decode($dish, true)['data']);

            // if is not public
            if(!$data['data']['public'])
            {
                // && if user OR household_member is not the owner

                if($GLOBALS['isHousehold'])
                {
                    $household_members_IDs = collect($GLOBALS['household_members'])->pluck('user_id')->toArray();
                    if( ! in_array($data['data']['owner_id'], $household_members_IDs) )
                    {
                        return redirect()->route('home');
                    }
                }
                else if($data['data']['owner_id'] != Auth::id())
                {
                    return redirect()->route('home');
                }
            }
            // dd($data['data']['owner_id'] != Auth::id());
            $data['restaurants'] = [];
        }
        else // teh slug is string && dish_type is S
        {
            $dish = $this->dishService->obtainDish($slug);
            $dish = json_decode($dish, true);
            // if( isset($dish['slug']) )
            // {
            //     $slug = $dish['slug'];
            // }

            $data['restaurants'] = collect([]);
            // dd($dish);

            if( isset($dish['restaurants']) )
            {
                // get restaurants & set $data['restaurants']
                $restaurants_ids = collect($dish['restaurants'])->pluck('restaurant_id')->toArray();
                $restaurants = $this->restaurantService->obtainByIDs($restaurants_ids, \Cookie::get('city'));


                $radius = \Cookie::get('range');
                $latlng = \Cookie::get('lat').'|'.\Cookie::get('long');
                $restaurants = $this->restaurantService->obtainRestaurantsByLocation($latlng, $radius);
                if( json_decode($restaurants) && isset(json_decode($restaurants)->data) )
                {
                    $restaurants = collect(json_decode($restaurants)->data);
                    $data['restaurants'] = $restaurants;
                }
                // dd($dish, $slug, $restaurants);
            }
            // dd($dish, $slug);
            $data['data'] = $dish;
        }


        $data['dish_pictures'] = [];
        if($files = Storage::files('dishes/'.$slug)):
            foreach($files as $file_path)
            {
                $parts = explode('/', $file_path);
                $dish_pictures[] = [$parts[1], $parts[2]];
            }
            $data['dish_pictures'] = $dish_pictures;
        endif;

        return view('static.dish.single.index', $data);
    }

    public function restaurant($slug)
    {
        $restaurant_pictures = [];
        
        $restaurant = $this->restaurantService->obtainRestaurant(urlencode($slug));
        $data = json_decode($restaurant, true);
        
        if( null === $data['data'] ) return abort(404);

        if($files = Storage::files('restaurants/'.$slug)):
            foreach($files as $file_path)
            {
                $parts = explode('/', $file_path);
                $restaurant_pictures[] = [$parts[1], $parts[2]];
            }
            $data['restaurant_pictures'] = $restaurant_pictures;
        else:
            $data['restaurant_pictures'] = [];
        endif;

        if(isset($data['data']['categories'])):
            foreach($data['data']['categories'] as $restaurant_category)
            {
                $GLOBALS['categories'][$restaurant_category['category']] = $restaurant_category;
            }
            $GLOBALS['all_categories'] = $GLOBALS['categories'];
        endif;

        // dd($data);

        return view('static.restaurant.single.index', $data);
    }
}
