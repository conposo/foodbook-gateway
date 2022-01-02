
@extends('layouts.app')

@section('content')

    <div class="container-fluid mb-5">
        @include('static.category.partials.header')

        <?php
        $B_dishes = collect($B_dishes);
        // dd($B_dishes);
        ?>

        @if($B_dishes->isNotEmpty())
            <div class="row mt-5">
                <div class="col col-md-5 mx-auto d-flex justify-content-between align-items-end">
                    <h4 class="category_name d-block">
                        От заведенията
                        <span>От заведенията</span>
                    </h4>
                    <a href="#" class="edit-category">
                        <sup style="font-size: 40px; color: #000000;">
                        <i class="fas fa-info"></i>
                    </sup>
                    </a>
                </div>
            </div>
            <div class="_wrapp_dishes owl-carousel">
                @include('static.category.partials.dishes', ['dish_type' => 'B', 'dishes' => $B_dishes])
            </div>
        @endif
        
        <?php
        // dd( $B_dishes );
        // dd( Cookie::get('lat') );

        $dishes = collect($data)->shuffle();
        if($dishes->isNotEmpty()):
            foreach($GLOBALS['dish_default_types'][$category_name] as $tag) {
                $tag = $tag['slug'];
                $dishes[$tag] = $dishes->filter(function($item) use ($tag) {
                    if(isset($item['tags'])):
                        foreach($item['tags'] as $this_tag) {
                            if($this_tag == $tag)
                                return $item;
                        };
                    endif;
                });
            }
            // var_dump($type);
            // dd($type);
            // dd($user_data);
            ?>
            @if(isset($_GET['tags']))
                <?php
                // $types = [];
                // $tags = explode(',', $_GET['tags']);
                // foreach($tags as $tag)
                // {
                //     $types[] = $GLOBALS['dish_types'][$category_name][$tag]['bg_name'];
                // }
                // $types = implode(', ', $types);
                // dd($dishes->shuffle());
                ?>
                @include('static.category.partials.subheader', ['type' => ''])
                <div class="_wrapp_dishes owl-carousel">
                    @include('static.category.partials.dishes', ['dish_type' => 'S', 'dishes' => $dishes->shuffle()])
                </div>
            @else
                @foreach($GLOBALS['dish_default_types'][$category_name] as $type)
                    @include('static.category.partials.subheader', ['type' => $type['slug']])
                    <div class="_wrapp_dishes owl-carousel">
                        @include('static.category.partials.dishes', ['dish_type' => 'S', 'dishes' => $dishes->get($type['slug'])->shuffle()])
                    </div>
                @endforeach
            @endif
        <?php
        endif;
        ?>

        @if($user_data->isNotEmpty())
            <div class="row mt-5">
                <div class="col col-md-5 mx-auto d-flex justify-content-between align-items-end">
                    <h4 class="category_name d-block text-capitalize">
                        <!-- Авторски -->
                        Моите рецепти
                        <span>Моите рецепти</span>
                    </h4>
                    <a href="{{ route('recipes') }}" class="edit-category">
                        <sup style="font-size: 40px; color: #000000;">
                        <i class="fas fa-external-link-alt"></i>
                    </sup>
                    </a>
                </div>
            </div>
            <div class="_wrapp_dishes owl-carousel">
                @include('static.category.partials.dishes', ['dish_type' => 'P', 'dishes' => $user_data])
            </div>
        @endif

    </div>

    @include('static.category.modals.add_dish')
    @if($dishes->isNotEmpty())
        @include('static.category.modals.edit_category')
    @endif

    <script>
    $(document).ready(function() {
        var owl_ = $('._wrapp_dishes');
        owl_.owlCarousel({
            //autoplay: true,
            nav: false,
            dots: true,
            loop: false,
            autoWidth: false,
            items: 5,
            lazyLoad: true,
            lazyLoadEager: 1,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:3,
                },
                1280:{
                    items:4,
                },
                1440:{
                    items:4,
                },
                1650:{
                    items:5,
                },
                1920:{
                    items:6,
                },
                2560:{
                    items:7,
                }
            }
        })
    })
    
    </script>
@endsection