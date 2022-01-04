<?php
$ingredients = false;
?>
<div class="_owl-lazy position-relative mx-1 dish item justify-content-between align-items-center"
        style="
            padding-top: 50px;
            height: auto;
            max-height: 1000px;
            background-size: cover;
            background-position: center center;
            background-image: url('/storage/images/dishes/{{$dish['slug']}}/main.jpeg');
            <?= !!!$ingredients ? 'white-space: nowrap;': '' ?>
            "
        data-src="/storage/images/dishes/{{$dish['slug']}}/main.jpeg">
    <span id="_{{$dish['id']}}" class="_bg w-100 px-2 px-md-5 pb-2 pb-md-5 dish_row d-flex flex-column justify-content-between align-items-center">
        <a href="{{ route('dish', $dish['slug']) }}"
            class="position-relative w-100 text-center"
            style="
                font-weight: 500;
                /* max-height: 33px; */
                z-index: 9;
                color:white;
                font-size: 22px;
                text-shadow: 0 0 12px #000;
                overflow: hidden;">
            <div class="who_cook d-none i_cook">Аз ще готвя</div>
            <div class="who_cook d-none restaurant_cook">Заведения в които се предлага</div>
            {{ substr($dish['bg_name'], 0, 450) }}
        </a>
        <span class="position-absolute change_quantity d-flex align-items-center">
            @if( !Request::is('/') )
            <form action="{{ route('meal-dish-remove', $_meal_data['id']) }}" method="POST">
                @csrf
                @method('DELETE')

                @if( $GLOBALS['isHousehold'] && !isset($_GET['user_type']) )
                <input type="hidden" name="user_type[]" value="household">
                <input type="hidden" name="user_type_id" value="{{$GLOBALS['household_id']}}">
                @elseif(isset($_GET['user_type']) && $_GET['user_type'] == 'user')

                @endif
                <button type="submit"class="text-white btn btn-link btn-lg mx-2 px-2">-</button>
            </form>
            @endif
            <span class="@if( Request::is('/') ) btn disabled @endif" style="font-size:1.3rem;">{{ $_meal_data['quantity'] }}</span>
            @if( !Request::is('/') )
            <form action="{{ route('meal-dish-increase-quantity', $_meal_data['id']) }}" method="POST">
                @csrf
                @method('PATCH')

                <?php
                $dish_type = '';
                // $dish_slug_parts = explode('-', $dish['slug']);
                // if( is_numeric(array_pop($dish_slug_parts)) )
                //     $dish_type = 'P';
                // else
                //     $dish_type = 'S';
                ?>

                @if( $GLOBALS['isHousehold'] && !isset($_GET['user_type']) )
                <input type="hidden" name="user_type[]" value="household">
                <input type="hidden" name="user_type_id" value="{{$GLOBALS['household_id']}}">
                @elseif(isset($_GET['user_type']) && $_GET['user_type'] == 'user')

                @endif

                <!-- <input type="hidden" name="dish_id" value="{{$dish['id']}}"> -->
                <!-- <input type="hidden" name="dish_type" value="{{$dish_type}}"> -->
                <!-- <input type="hidden" name="id" value="{{$_meal_data['id']}}"> -->
                <!-- <input type="hidden" name="quantity"> -->
                <button type="submit" class="text-white btn btn-link btn-lg mx-2 px-2">+</button>
            </form>
            @endif
        </span>
    </span>
    @if( !Request::is('/') )
    <div class="position-relative px-2 px-md-5 pb-5 cook collapse {{ (isset($GLOBALS['is_list']) && $GLOBALS['is_list']) ? 'show' : '' }}" id="collapse_{{$dish['id']}}">
        <div class="accordion" id="accordion">
            @include('meals.partials.dish_ingredients')
            @include('meals.partials.dish_restaurants')
        </div>
    </div>
    @endif
</div>

