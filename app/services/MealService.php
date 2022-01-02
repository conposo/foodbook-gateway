<?php

namespace App\Services;

use App\Traits\ConsumeService;

class MealService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.meals.base_uri');
    }

    public function obtainMeals()
    {
        $args = array_combine(['user_type', 'user_type_id', 'date'], func_get_args());
        $args = implode('/', $args); // user/1/2019-01-11/05:00
        // dd($args);
        return $this->performRequest('GET', "meals/{$args}?");
    }

    public function obtainMeal()
    {
        $args = array_combine(['user_type', 'user_type_id', 'date', 'time'], func_get_args());
        $args = implode('/', $args); // user/1/2019-01-11/05:00
        // dd($args);
        return $this->performRequest('GET', "meal/{$args}?");
    }

    public function postDishToMeal($data)
    {
        // parameters
        // date / time / user_type / user_type_id / dish_type / dish_id
        // dd($data);
        return $this->performRequest('POST', "meal-dish", $data);
    }

    public function increaseQuantityDishToMeal($meal_id)
    {
        return $this->performRequest('PATCH', "meal-dish/{$meal_id}");
    }

    public function deleteDishFromMeal($meal_id)
    {
        return $this->performRequest('DELETE', "meal-dish/{$meal_id}");
    }
}