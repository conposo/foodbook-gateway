<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

use App\Services\MealService;

class MealsDishController extends Controller
{
    protected $mealService;

    public function __construct(MealService $mealService)
    {
        $this->mealService = $mealService;

        $this->date = $GLOBALS['date'];
        $this->time = $GLOBALS['meal_time'];
    }

    public function store(Request $request)
    {
        // dd($GLOBALS['user_type_id']);
        $this->user_type = $GLOBALS['user_type'];
        $this->user_type_id = $GLOBALS['user_type_id'];
        
        // dd($request->user_type, $this->user_type, $this->user_type_id, $request);

        if($request->user_type)
        {
            $this->user_type = $request->user_type[0];
            if($this->user_type == 'household')
            {
                $this->user_type_id = $GLOBALS['household_id'];
            }
        }

        // dd($this->user_type, $this->user_type_id, $request->except('_token', 'dish_count', 'quantity'));

        // parameters
        // date / time / user_type / user_type_id / dish_type / dish_id
        $data = $request->except('_token', 'dish_count', 'quantity');
        $data['date'] = $this->date;
        $data['time'] = $this->time;
        $data['user_type'] = $this->user_type;
        $data['user_type_id'] = $this->user_type_id;
        $_response = $this->mealService->postDishToMeal($data);
        // dd($_response);
        if($_response)
        {
            $user_type_redierect = ($this->user_type == 'user') ? ['user_type' => 'user']: [];
            return redirect()->route(Cookie::get('meal'), $user_type_redierect);
        }
    }

    public function increaseQuantity(Request $request, $meal_id)
    {
        $this->user_type = $GLOBALS['user_type'];
        if($request->user_type)
        {
            $this->user_type = $request->user_type;
            if($this->user_type == 'household') $this->user_type_id = $GLOBALS['household_id'];
        }
        $_response = $this->mealService->increaseQuantityDishToMeal($meal_id);
        if($_response)
        {
            $user_type_redierect = ($this->user_type == 'user') ? ['user_type' => 'user']: [];
            return redirect()->route(Cookie::get('meal'), $user_type_redierect);
        }
    }

    public function destroy(Request $request, $meal_id) // delete || decrease quantity
    {
        $this->user_type = $GLOBALS['user_type'];
        if($request->user_type)
        {
            $this->user_type = $request->user_type;
            if($this->user_type == 'household') $this->user_type_id = $GLOBALS['household_id'];
        }
        // dd($meal_id);
        $_response = $this->mealService->deleteDishFromMeal($meal_id);
        // dd($_response);
        if($_response)
        {
            $user_type_redierect = ($this->user_type == 'user') ? ['user_type' => 'user']: [];
            return redirect()->route(Cookie::get('meal'), $user_type_redierect);
        }
    }
}
