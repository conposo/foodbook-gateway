
    <?php
    // dd($data['restaurants'], $restaurants->where('id', 1)->where('city', 'Ruse')->first());

    $count_all_restaurants = 0;
    $html_restaurants = '';
    foreach( $data['restaurants'] as $data_restaurant ):
        // $data_restaurant = $restaurants->where('id', '=', $data_restaurant['restaurant_id'])->where('city', '=', $GLOBALS['city'])->first();
        // $restaurant = $restaurants->where('id', '=', $data_restaurant['restaurant_id'])->where('city', '=', 'Ruse')->first();
        $restaurant = $restaurants->where('id', '=', $data_restaurant['restaurant_id'])->first();
        // var_dump($restaurant);
        if($restaurant):
            $count_all_restaurants++;
            $html_restaurants .= '
            <div class="item d-flex justify-content-between align-items-center text-center">
                <a class="restaurant-link position-relative text-white w-100 p-3 d-flex align-items-center"
                    href="'. route('restaurant', $restaurant->slug) .'" data-toggle="tooltip" data-placement="right" title="Виж повече"
                    style="background-image: url(\'/images/other/logo.png\'); 
                    background-size: contain;
                    background-repeat: no-repeat; background-position:center;">
                    <img class="d-flex position-absolute bg" src="/images/restaurants/'.$restaurant->slug.'/main.jpeg" >
                    <img class="d-flex position-relative" src="/images/restaurants/'.$restaurant->slug.'/main.jpeg" >
                    <span class="position-absolute w-auto text-center py-3">'. $restaurant->business_name .'</span>
                </a>
            </div>';
        endif;
    endforeach;
    ?>

    @if($html_restaurants)
    <section class="position-relative d-flex align-items-center" style="height: calc(100vh);">
        <div class="w-100 position-relative d-flex-column align-items-center">
            <h4 class="text-center mb-4 font-weight-normal">
                <span style="font-family: cheque-black; font-size: 1.4rem;">{{ $dish['bg_name'] }}</span>
                <span class="d-block" style="color: brown; font-size: 0.85rem;"><i>може да намерите тук</i></span>
            </h4>
            <div class="owl-carousel mb-2 owl-carousel_restaurants">
                <?php echo($html_restaurants) ?>
            </div>
        </div>
        <a class="d-none d-md-block next-section position-absolute text-dark rr1" href="#" onclick="$('.rr1').hide()">
            <i class="fas fa-chevron-down"></i>
        </a>
    @endif

    <script>
        var owl_restaurants = $('.owl-carousel_restaurants');
        owl_restaurants.owlCarousel({
            //autoplay: true,
            loop: false,
            margin:10,
            // autoWidth: true,
            // lazyLoad: true,
            // lazyLoadEager: 1,
            dots: true,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 2,
                },
                // breakpoint from 480 up
                480 : {
                    items: 3,
                },
                // breakpoint from 768 up
                768 : {
                    items: <?= ($count_all_restaurants <= 3) ? 1 : ( ($count_all_restaurants >= 6) ? 6 : 3 ); ?>,
                }
            }
        });
        $(document).ready(function(){
            $('.restaurant-link').each(function(){
                $(this).height($(this).width())
            })
        });
    </script>

    <style>
    .restaurant-link {
        font-size: 16px;
        font-weight: 500;
        overflow: hidden;
        border-radius: 10px;
        border: 2px solid rgb(252, 245, 235);
    }
    .restaurant-link:before {
            content: '';
            position: absolute;
            z-index: 0;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0, 0.25);
    }
    .restaurant-link img.bg {
        transform: scale(1.1);
        filter:blur(8px);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .restaurant-link img {
        z-index: 2;
        border-radius: 10px;
    }
    .restaurant-link img,
    .restaurant-link span {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .restaurant-link span {
        /* width: auto;
        z-index: 1;
        top: calc( 50% - 28px );
        right: 50px;
        left: 50px;
        display: block;
        font-size: 24px;
        line-height: 24px; */
        
        width: auto;
        z-index: 1;
        top: 5px;
        bottom: 5px;
        right: 5px;
        left: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
        font-size: 30px;
        line-height: 34px;
        font-family: cheque-black;
    text-shadow: 0 0 10px rgb(0 0 0 / 0.5);
    }
    </style>

</section>