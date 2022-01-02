
@extends('layouts.app')

@section('content')

    <?php
    // dd($meal_data, $dishes);
    switch($GLOBALS['meal'])
    {
        case 'breakfast':
            $meal_slug_title = ['breakfast','Закуска'];
            break;
        case 'lunch':
            $meal_slug_title = ['lunch','Обяд'];
            break;
        case 'dinner':
            $meal_slug_title = ['dinner','Вечеря'];
            break;
    }

    ?>
<div class="_container">
    <div class="custom_w-50 px-3 px-md-5 mx-auto">

        @include('meals.partials.header')

        @include('meals.partials.meal')

        <div class="text-center">
            <a class="d-block text-black-50 my-5 add_" style="cursor:pointer; margin-bottom:150px !important;"
                data-toggle="modal"
                data-target="#showCategories"><span style="font-size:3.6rem; font-weight:100;">+</span></a>
        </div>

        @include('meals.modals.categories')

        <!-- @ include('meals.partials.print_meal.ctas') -->
        @if( $meal_data->isNotEmpty() )
        <div class="container-fluid border-top position-fixed px-md-3 w-100"
            style="
                z-index: 999;
                bottom: 0;
                left: 0;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: floralwhite;
            ">
            <div class="row">
                <div class="d-flex justify-content-center  col<?= (isset($category_name)) ? '-12 _col-xl-9': '-12 col-sm-10 col-md-8 col-lg-6 col-xl-5' ?> mx-auto">
                <button class="_font-weight-bold bg-transparent btn btn-lg _rounded-circle text-black-50 _btn-outline-secondary mr-3"
                    onclick="$('._restaurants').collapse('hide');$('._ingredients').collapse('show'); $('.cook').collapse('show'); $('.who_cook').addClass('d-none'); $('.i_cook').removeClass('d-none');"
                    >Аз ще готвя <i class="d-block far fa-smile pb-1"></i></button>
                <button class="_font-weight-bold bg-transparent btn btn-lg _rounded-circle text-black-50 _btn-outline-secondary"
                    @if($GLOBALS['is_list']) _disabled style="opacity:0.5" @endif
                    onclick="$('._ingredients').collapse('hide');$('._restaurants').collapse('show'); $('.cook').collapse('show'); $('.who_cook').addClass('d-none'); $('.restaurant_cook').removeClass('d-none');"
                    >Друг ще готви <i class="d-block far fa-smile-wink pb-1"></i></button>
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

<style>
.meal_title {
    font-family: cheque-black;
}
</style>

@endsection