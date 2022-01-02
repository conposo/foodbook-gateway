
@extends('layouts.app')

@section('content')

    @if (session('verified'))
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
            Cool!
            </strong>
            Твоят имейл е потвърден.
            <!-- You should check in on some of those fields below. -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif
    
    <?php
    // dd($system_dishes);
    $meal_for_breakfast = collect($data)->where('time', '=', '05:00');
    
    $system_dish_ids_for_breakfast = $meal_for_breakfast->where('dish_type', 'S')->pluck('dish_id', 'id')->toArray();
    $system_dishes_for_breakfast =  $system_dishes->whereIn('id', $system_dish_ids_for_breakfast);

    $personal_dish_ids_for_breakfast = $meal_for_breakfast->where('dish_type', 'P')->pluck('dish_id', 'id');
    $personal_dishes_for_breakfast =  $personal_dishes->whereIn('id', $personal_dish_ids_for_breakfast);
    
    $B_dish_ids_for_breakfast = $meal_for_breakfast->where('dish_type', 'B')->pluck('dish_id', 'id');
    $B_dishes_for_breakfast =  $B_dishes->whereIn('id', $B_dish_ids_for_breakfast);
    // dd( $personal_dishes_for_breakfast );

    $dishes_for_breakfast = $system_dishes_for_breakfast->merge($personal_dishes_for_breakfast)->merge($B_dishes_for_breakfast); 


    // Lunch
    $meal_for_lunch = collect($data)->where('time', '=', '11:00');
    
    $system_dish_ids_for_lunch = $meal_for_lunch->where('dish_type', 'S')->pluck('dish_id', 'id')->toArray();
    $system_dishes_for_lunch =  $system_dishes->whereIn('id', $system_dish_ids_for_lunch);

    $personal_dish_ids_for_lunch = $meal_for_lunch->where('dish_type', 'P')->pluck('dish_id', 'id')->toArray();
    $personal_dishes_for_lunch =  $personal_dishes->whereIn('id', $personal_dish_ids_for_lunch);

    $B_dish_ids_for_lunch = $meal_for_lunch->where('dish_type', 'B')->pluck('dish_id', 'id');
    $B_dishes_for_lunch =  $B_dishes->whereIn('id', $B_dish_ids_for_lunch);

    $dishes_for_lunch = $system_dishes_for_lunch->merge($personal_dishes_for_lunch)->merge($B_dishes_for_lunch); 
    // dd($dishes_for_lunch);

    $meal_for_dinner = collect($data)->where('time', '=', '17:00');
    
    $system_dish_ids_for_dinner = $meal_for_dinner->where('dish_type', 'S')->pluck('dish_id', 'id')->toArray();
    $system_dishes_for_dinner =  $system_dishes->whereIn('id', $system_dish_ids_for_dinner);

    $personal_dish_ids_for_dinner = $meal_for_dinner->where('dish_type', 'P')->pluck('dish_id', 'id')->toArray();
    $personal_dishes_for_dinner =  $personal_dishes->whereIn('id', $personal_dish_ids_for_dinner);

    $B_dish_ids_for_dinner = $meal_for_dinner->where('dish_type', 'B')->pluck('dish_id', 'id');
    $B_dishes_for_dinner =  $B_dishes->whereIn('id', $B_dish_ids_for_dinner);

    $dishes_for_dinner = $system_dishes_for_dinner->merge($personal_dishes_for_dinner)->merge($B_dishes_for_dinner);  
    ?>

    <div class="custom_w-50 px-3 px-md-5 mx-auto">
        @php($meal_slug_title = ['breakfast','Закуска'])
        @include('meals.partials.header', ['meal' => $meal_for_breakfast])
        @include('meals.partials.meal', ['meal' => $meal_for_breakfast, 'dishes' => $dishes_for_breakfast])
        @include('meals.partials.add_meal', ['where' => 'breakfast'])

        @php($meal_slug_title = ['lunch','Обяд'])
        @include('meals.partials.header', ['meal' => $meal_for_lunch])
        @include('meals.partials.meal', ['meal' => $meal_for_lunch, 'dishes' => $dishes_for_lunch])
        @include('meals.partials.add_meal', ['where' => 'lunch'])

        @php($meal_slug_title = ['dinner','Вечеря'])
        @include('meals.partials.header', ['meal' => $meal_for_dinner])
        @include('meals.partials.meal', ['meal' => $meal_for_dinner, 'dishes' => $dishes_for_dinner])
        @include('meals.partials.add_meal', ['where' => 'dinner'])
    </div>

@endsection