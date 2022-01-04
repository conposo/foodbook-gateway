@extends('layouts.app')

@section('content')

    <div class="custom_w-50 px-3 px-md-5 mx-auto">

        @include('static.category.partials.header')

        <?php
        $dishes = collect($data)->shuffle();
        // dd($dishes);
        if( $dishes->isNotEmpty() ):
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
            ?>
            @foreach($GLOBALS['dish_default_types'][$category_name] as $type)
                @include('home.category.partials.subheader', ['type' => $type['slug']])
                <div class="dishes">
                    @include('home.category.partials.dishes', ['dish_type' => 'S', 'dishes' => $dishes->get($type['slug'])->shuffle()])
                </div>
            @endforeach
        <?php
        endif;
        ?>

    </div>

    @include('partials.see_more', ['content_type' => 'categories'])

    <script type="text/javascript">
        $(document).ready(function(){
            $('.dishes').slick({
                lazyLoad: 'ondemand',
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 8,
                slidesToScroll: 8,
                responsive: [
                    {
                        breakpoint: 1920,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 6,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                    breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });
    </script>
    
@endsection
