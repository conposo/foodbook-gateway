
<?php
// dd($GLOBALS['categories'], $dishes, $meal_data);
?>

@foreach($GLOBALS['categories'] as $category_slug => $category)
    @php($_dishes = $dishes->where('category', $category_slug)->toArray())

    <?php
    // dd($category, $_dishes);
    ?>
    @if($_dishes)
    <div class="wrapper mb-3 d-flex-column align-items-center">

        <h6 class="mx-3 text-uppercase">
            <a class="text-black-50"
                href="{{route('category', ['category_name' => $category['slug']])}}">
                <b>{{$category['bg_name']}}</b>
                <i class="fas fa-external-link-alt" style="font-size: 12px;top: -20px;left: -5px;position: relative;"></i>
            </a>
        </h6>

        <div class="dishes position-relative d-flex flex-fill align-items-center">
            <div class="w-100 owl-carousel owl-carousel_{{$meal_slug_title[0]}}{{ str_replace('-', '_', $category['slug']) }}">
                @foreach($_dishes as $dish)
                    @if( isset($dish['owner_type']) && $dish['owner_type'] == 'P' )
                        @php( $filtered_meal_data = $meal_data->where('dish_id', $dish['id'])->where('dish_type', 'P')->first() )
                    @elseif( isset($dish['owner_type']) && $dish['owner_type'] == 'B' )
                        @php( $filtered_meal_data = $meal_data->where('dish_id', $dish['id'])->where('dish_type', 'B')->first() )
                    @else
                        @php( $filtered_meal_data = $meal_data->where('dish_id', $dish['id'])->first() )
                    @endif
                    @include('meals.partials.dish', ['_meal_data' => $filtered_meal_data])
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endforeach