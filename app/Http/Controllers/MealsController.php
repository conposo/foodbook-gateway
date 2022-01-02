<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\DishService;
use App\Services\MealService;
use App\Services\RestaurantService;

class MealsController extends Controller
{
    protected $dishService;
    protected $mealService;
    protected $date;
    protected $time;
    protected $user_type;
    protected $user_type_id;

    public function __construct(DishService $dishService, MealService $mealService)
    {
        $this->dishService = $dishService;
        $this->mealService = $mealService;

        $this->date = $GLOBALS['date'];
        $this->time = $GLOBALS['meal_time'];

        $this->user_type = 'user';

        $this->middleware(function (Request $request, $next) {
            $this->user_id = \Auth::id();
            if($request->user_type)
            {
                $this->user_type = $request->user_type;
                $this->user_type_id = $this->user_id;
            }
            elseif($GLOBALS['isHousehold'])
            {
                $this->user_type = 'household';
                $this->user_type_id = $GLOBALS['household_id'];
            }
            else
            {
                $this->user_type = 'user';
                $this->user_type_id = $this->user_id;
            }

            return $next($request);
        });
    }

    public function index()
    {
        $personal_dishes = [];
        $B_dishes = [];
        $data = $this->mealService->obtainMeals($this->user_type, $this->user_type_id, $this->date);
        $data = collect( json_decode($data, true) );

        $system_dishes = $data->where('dish_type', 'S');
        $_personal_dishes = $data->where('dish_type', 'P');
        $_B_dishes = $data->where('dish_type', 'B');

        $system_dishes_ids = array_unique( $system_dishes->pluck('dish_id')->toArray() );
        
        $B_dishes_ids = array_unique( $_B_dishes->pluck('dish_id')->toArray() );
        // dd( $personal_dishes );

        // if($_personal_dishes->isNotEmpty())
        // {
        // }
        $personal_dishes_ids = array_unique( $_personal_dishes->pluck('dish_id')->toArray() );
        foreach($personal_dishes_ids as $id)
        {
            $_dish = $this->dishService->obtainByTypeAndId('P', $id);
            // var_dump( $_dish );
            if( json_decode($_dish, true) && isset(json_decode($_dish, true)['data']) )
            {
                $personal_dishes[] = collect(json_decode($_dish, true)['data'])->toArray();
            }
        }
        foreach($B_dishes_ids as $id)
        {
            $_dish = $this->dishService->obtainByTypeAndId('B', $id);
        // dd( $B_dishes_ids, $_dish );
            if( json_decode($_dish, true) && isset(json_decode($_dish, true)['data']) )
            {
                $B_dishes[] = collect(json_decode($_dish, true)['data'])->toArray();
            }
        }

        // $personal_dishes = $this->dishService->obtainByOwner('P', $this->user_id);
        // $personal_dishes = json_decode($personal_dishes, true);
        // $personal_dishes = collect($personal_dishes['data'])->whereIn('id', $personal_dishes_ids);

        $system_dishes = $this->dishService->obtainByIDs($system_dishes_ids);
        $system_dishes = json_decode($system_dishes, true);

        // dd($data, $personal_dishes);
        $data = ['meal_data' => $data, 'data' => $data, 'system_dishes' => collect($system_dishes), 'personal_dishes' => collect($personal_dishes), 'B_dishes' => collect($B_dishes)];
        return view('meals.all.index', $data);
    }

    public function getMeal()
    {
        $data = $this->mealService->obtainMeal($this->user_type, $this->user_type_id, $this->date, $this->time);
        $data = collect( json_decode($data, true) );
        if($data->isNotEmpty())
        {
            $personal_dishes = [];
            $B_dishes = [];
            $system_dishes = $data->where('dish_type', 'S');
            $_personal_dishes = $data->where('dish_type', 'P');
            $_B_dishes = $data->where('dish_type', 'B');
            // dd( $_B_dishes );
            $system_dishes_ids = array_unique( $system_dishes->pluck('dish_id')->toArray() );
            $personal_dishes_ids = array_unique( $_personal_dishes->pluck('dish_id')->toArray() );
            $B_dishes_ids = array_unique( $_B_dishes->pluck('dish_id')->toArray() );
            foreach($personal_dishes_ids as $id)
            {
                $_dish = $this->dishService->obtainByTypeAndId('P', $id);
                if( json_decode($_dish, true) && isset(json_decode($_dish, true)['data']) )
                {
                    $personal_dishes[] = collect(json_decode($_dish, true)['data'])->toArray();
                }
            }
            foreach($B_dishes_ids as $id)
            {
                $_dish = $this->dishService->obtainByTypeAndId('B', $id);
            // dd( $B_dishes_ids, $_dish );
                if( json_decode($_dish, true) && isset(json_decode($_dish, true)['data']) )
                {
                    $B_dishes[] = collect(json_decode($_dish, true)['data'])->toArray();
                }
            }
    
            // $personal_dishes = $this->dishService->obtainByOwner('P', $this->user_type_id);
            // $personal_dishes = json_decode($personal_dishes, true);
            $system_dishes = $this->dishService->obtainByIDs($system_dishes_ids);
            $system_dishes = json_decode($system_dishes, true);
            
            // $personal_dishes = collect($personal_dishes['data'])->whereIn('id', $personal_dishes_ids);
            $dishes = collect($system_dishes)->merge($personal_dishes)->merge($B_dishes);
    
            // dd($dishes);
            // get restaurants
            $restaurants = collect([]);
            $_restaurants = array_filter($dishes->pluck('restaurants')->toArray());
            // dd($_restaurants);
            if(collect($_restaurants)->isNotEmpty()):
                $restaurantService = New RestaurantService;
                $restaurant_ids = ( collect(array_merge(...$_restaurants))->pluck('restaurant_id')->toArray() );

                // $latlng = \Cookie::get('lat').'|'.\Cookie::get('long');
                // $restaurants = $restaurantService->obtainRestaurantsByLocation('latlng', 'radius=3');
                $restaurants = $restaurantService->obtainByIDs($restaurant_ids, \Cookie::get('city'));
                if($restaurants)
                {
                    if( json_decode($restaurants, true) && isset(json_decode($restaurants, true)['data']) )
                    {
                        $restaurants = collect(json_decode($restaurants, true)['data']);
                    }
                }
                // dd($restaurants);
            endif;

            // dd($data, $dishes);
            $view_data = ['meal_data' => $data, 'dishes' => $dishes, 'restaurants' => $restaurants];
        }
        else
        {
            $view_data = ['meal_data' => collect([]), 'dishes' => collect([]), 'restaurants' => collect([])];
        }
        return view('meals.single.index', $view_data);
    }

    public function store()
    {
        // To-Do
        // create new Kind of Meal
    }
}
