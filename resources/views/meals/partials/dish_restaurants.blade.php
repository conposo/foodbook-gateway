
<div class="">
    <button class="d-none btn btn-link collapsed" type="button" data-toggle="collapse" data-target=".manage" aria-expanded="false" aria-controls="collapseTwo">
        Заведения
    </button>
    <div id="collapseTwo" class="manage _restaurants collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <?php
        // var_dump($restaurants);
        ?>

        @if( isset($dish['owner_type']) )
            @if( $dish['owner_type'] == "P" )
            Това ястие все още го няма по заведенията
            @endif
            @if( $dish['owner_type'] == "B" )
            <!-- Това ястие го има само в това заведение -->
            @endif
        @else:
        <div class="list restaurants">
            <?php
            // if( isset($GLOBALS['city']) && $GLOBALS['city'] != '' )
            //     $restaurants = \App\Restaurant::where('city', '=', $GLOBALS['city'])->find( json_decode($item->restaurants_ids) );
            // else
            //     $restaurants = \App\Restaurant::find( json_decode($item->restaurants_ids) );
            // dd($restaurants);
            // var_dump($restaurants);
            if($restaurants && $restaurants->isNotEmpty()):
                foreach($restaurants as $_restaurant):
                    ?>
                    <div class="pl-1 my-1 d-flex flex-fill justify-content-between align-items-center">
                        <a class=" d-flex flex-fill justify-content-between align-items-center text-white" href="{{route('restaurant', $_restaurant['slug'])}}" style="font-weight:500;text-shadow: 0 0 12px rgba(0, 0, 0, 0.5);">
                            {{$_restaurant['business_name']}}
                            <i class="far fa-calendar-alt text-white"></i>
                        </a>
                    </div>
                    <?php
                endforeach;
            else:
                ?>
                <div class="text-center">
                    Все още не знаем къде се предлага <b>{{$dish['bg_name']}}</b>.
                    <!-- Ако ти знаеш, можеш да ни пишеш за да добавим :) -->
                </div>
                <?php
            endif;
            ?>
        </div>
        @endif
    </div>
</div>
