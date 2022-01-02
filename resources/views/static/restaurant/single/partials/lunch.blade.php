
<?php
if( false && ($isOwner || $isChef) && !$isMenu ):
    ?>
    
<div id="menu_for_lunch" class="container pb-5">
    <div class="row">
        <div class="col-12 col-lg-8 pt-lg-5 px-lg-5 mx-auto">


            <h2 class="m-0 pb-2 border-bottom text-uppercase font-weight-normal text-center">
                <span class="btn-sm rounded-0 px-0 text-black-50 ">обедни предложения</span>
            </h2>

            <ul class="justify-content-between nav nav-tabs border-0" id="myTab" role="tablist">
            <?php
            foreach($days as $day => $bg_day)
            {
                ($bg_day == mb_strtolower($GLOBALS['today_formatted'])) ? $today = '_font-weight-bold _text-dark' : $today = '';
                ?>
                <li class="nav-item">
                    <a class="nav-link @if($today) active @endif bg-transparent border-0" id="{{$day}}-tab" data-toggle="tab" href="#{{$day}}" role="tab" aria-controls="{{$day}}" aria-selected="true">
                        <div style="font-size: 12px;" class="{{ $today }} text-capitalize">{{$bg_day}}</div>
                    </a>
                </li>
                <?php
            }
            ?>
            </ul>
            <div class="tab-content" id="myTabContent">
            <?php
            $thisYear = $GLOBALS['year'];
            $weekNum = $GLOBALS['week'];

            $date['monday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum"));
            $date['tuesday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-2"));
            $date['wednesday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-3"));
            $date['thursday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-4"));
            $date['friday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-5"));
            $date['saturday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-6"));
            $date['sunday'] = date('Y-m-d', strtotime("$thisYear-W$weekNum-7"));
            // dd($date);

            if(isset($restaurant['categories']) && $restaurant['categories']):
                $all_categories = json_decode($restaurant['categories'], true) + $GLOBALS['categories'];
            else:
                $all_categories = $GLOBALS['categories'];
            endif;
            foreach($days as $day => $bg_day)
            {
                ($bg_day == mb_strtolower($GLOBALS['today_formatted'])) ? $today = 'font-weight-bold text-dark' : $today = '';
                ?>
                <div class="tab-pane fade @if($today) show active @endif" id="{{$day}}" role="tabpanel" aria-labelledby="{{$day}}-tab">
                @if( isset($restaurant_dailies) && $restaurant_dailies )
                    <?php
                    $_restaurant_dailies = $restaurant_dailies->where('date', $date[$day]);
                    ?>
                    @if($_restaurant_dailies->isNotEmpty())
                    <?php
                    $__restaurant_dailies = $_restaurant_dailies->first()->toArray();
                    if($__restaurant_dailies['dishes_ids_for_lunch']):
                        
                        $restaurant_menu = json_decode($__restaurant_dailies['dishes_ids_for_lunch'], true);
                        if($restaurant_menu):
                            foreach($all_categories as $category => $category_attr)
                            {
                                if(isset($restaurant_menu[$category]))
                                {
                                    ?>
                                    <h4 class="d-flex justify-content-center align-items-center mt-5 mb-3 text-uppercase font-weight-normal">
                                        <span class="" style="color:brown; font-size: 0.5rem;">
                                            <i class="fas fa-star-of-life"></i>
                                            <i class="fas fa-star-of-life"></i>
                                            <i class="fas fa-star-of-life"></i>
                                        </span>
                                        <span class="mx-2">{{ $all_categories[$category]['bg_name'] }}</span>
                                        <span class="" style="color:brown; font-size: 0.5rem;">
                                            <i class="fas fa-star-of-life"></i>
                                            <i class="fas fa-star-of-life"></i>
                                            <i class="fas fa-star-of-life"></i>
                                        </span>
                                    </h4>
                                    <?php
                                    foreach($restaurant_menu[$category] as $dish)
                                    {
                                        ?>
                                        <div class="pl-3 d-flex justify-content-center align-items-center position-relative mb-3 rounded dish text-center" style="_background-size:cover; _background-image:url('/images/restaurants/{{ $restaurant['slug'] }}/main.jpeg')">

                                            <a class="d-block _pt-2" href="{{ route('dish', $dish[1]) }}">
                                                <span class="py-0">{{ $dish[2] }}</span> -
                                                <span class="" style="color:brown; font-size:1rem;">{{ (isset($dish[3])) ? $dish[3] : '0' }}<small style="margin-bottom: -3px;">лв.</small></span>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        endif;
                    else:
                    ?>
                    <div class="p-3 text-center">
                        <p>Все още няма меню за <span class="text-capitalize">{{$bg_day}}</span> </p>
                    </div>
                    <?php
                    endif;
                    ?>
                    @else
                    <div class="p-3 text-center">
                        <p>Все още няма меню за <span class="text-capitalize">{{$bg_day}}</span> </p>
                    </div>
                    @endif
                @endif
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>



    <div class="text-center">
        <h4>Все още няма нищо добавено във менюто</h4>
        <a class="my-5 btn btn-outline-primary" href="{{ route('restaurant-menu', ['slug' => $restaurant['slug']]) }}">Създай меню</a>
    </div>
    <?php
endif;
?>