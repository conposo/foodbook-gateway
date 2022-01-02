<?php
// dd($current_user_guest_data);
$user_guest_menu_dishes_ids = collect($current_user_guest_data['menu'])->pluck('dish_id')->toArray();
$dishes_from_restaurant = collect($restaurant['menu'])->whereIn('dish_id', $user_guest_menu_dishes_ids);
?>
    <div class=" mb-2 pb-3 d-flex-column d-lg-flex justify-content-between align-items-center w-100 border-bottom font-weight-normal">
        <span class="h5 font-weight-normal">
            Твоето меню <span class="d-none _d-sm-inline">за тази резервация</span> в
            <br class="d-md-none">
            <b>{{ $restaurant['business_name'] }}</b>
            @if( isset($reservation['table']) )
                за <b class="">маса №{{$reservation['table']}}</b>
            @endif
        </span>
        <span class="d-none _d-md-inline">
            <a class="btn btn-sm btn-outline-dark" href="{{route('dinner', ['date' => $reservation['date']])}}">    
                цялото меню за вечерта тук
            </a>
        </span>
    </div>
    <style>
    .active {
        
    }
    </style>
    <?php
    $total = 0;
    ?>
    @if( isset($current_user_guest_data['menu']) && $current_user_guest_data['menu'])
        @foreach($current_user_guest_data['menu'] as $item)
            <?php
            $dish_from_restaurant = $dishes_from_restaurant->where('dish_id', $item['dish_id'])->first();
            // dd($user_guest);
            ?>
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <span class="d-block py-2">
                    <a href="{{ route('dish', $item['dish_id']) }}">{{ $dish_from_restaurant['dish_name'] }}</a>
                    <span>
                        <?php
                        $combined_price =  App\Http\Controllers\Controller::combinePriceParts($dish_from_restaurant['dish_price']);
                        // $price = explode(".", $dish_from_restaurant['dish_price']);
                        $total += (int) $dish_from_restaurant['dish_price'];
                        // var_dump($total);
                        // if(isset($price[1]))
                        // {
                        //     if(strlen($price[1]) == 1)
                        //     {
                        //         echo ",{$price[1]}0";
                        //     }
                        //     else echo ",{$price[1]}";
                        // }
                        // else echo ',00';
                        echo $combined_price;
                        ?><small style="margin-bottom: -3px;">лв.</small>
                    </span>
                </span>
                @if( $item['status'] == 'pending')
                <form class="" action="{{route('reservation-dish-remove', ['id' => $reservation['id']]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="dish_id" value="{{$item['dish_id']}}">
                    <input type="hidden" name="guest_id" value="{{$current_user_guest_data['id']}}">
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <button type="submit" class="text-black-50 btn btn-link btn-sm mx-2 px-2">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
                @endif
            </div>
        @endforeach
    @else
        все още нямате добавени ястия
    @endif
    @if( $reservation['status'] == 'pending' || $reservation['status'] == 'approved' )
    <div class="d-flex justify-content-between align-items-center">
        <a class="mt-2 btn btn-outline-dark btn-sm" href="#"
            data-toggle="modal"
            data-target="#showCategories">добави още +</a>
        <span class="mr-3">
        Общо: <?php
            $combined_price =  App\Http\Controllers\Controller::combinePriceParts($total);
            // $price = explode(".", $total);
            // var_dump($price);
            // if(isset($price[1]))
            // {
            //     if(count($price[1]) == 1)
            //     {
            //         echo ".{$price[1]}0";
            //     }
            //     else echo ".{$price[1]}";
            // }
            // else echo '.00';
            echo $combined_price;
            ?><small class="" style="margin-left:2px; margin-bottom: -3px;">лв.</small>
        </span>
    </div>
    @endif

    <div class="mb-3 mb-sm-5">
        <h6 class="mt-5 pb-2 border-bottom font-weight-normal">Ястия които не са част от менюто на
            <br class="d-block d-sm-none">
            <b>{{ $restaurant['business_name'] }}</b>
        </h6>
        @if( false )
            <!-- if( !$dishes_out_restaurant->isEmpty() ) -->
            @foreach($dishes_out_restaurant as $dish)
                <!-- <div class="d-flex justify-content-between align-items-center">
                    <a class="my-1 d-block" href="{{ route('dish', $dish->slug) }}">{{$dish->bg_name}}</a>
                    <form class="d-none" action="{{ route('dish', 0) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                        <input type="hidden" name="guest_id" value="{{ $reservation_current_user->guest_id }}">
                        <input type="hidden" name="id" value="{{$reservation['id']}}">
                        <button type="submit" class="text-black-50 btn btn-link btn-sm mx-2 px-2">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                </div> -->
            @endforeach
        @else
            все още нямате добавени ястия
        @endif
    </div>
