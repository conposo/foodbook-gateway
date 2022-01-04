
@extends('layouts.app')

@section('content')

    @include('home.partials.intro')

    <div style="overflow: hidden;">
        @foreach($GLOBALS['categories'] as $group => $category)
        @php
            $_dishes = collect($dishes[$category['slug']])->shuffle();
            $rand = rand();
        @endphp
        <div class="position-relative mb-3 mb-md-5 pt-3 pt-md-5 px-3 px-md-5">
            <div class="d-flex justify-content-between align-items-center">
                <span class="cat_name_deco">{{$category['bg_name']}}</span>
                <a class="ps-1 pt-2 text-dark text-decoration-none text-uppercase" href="{{ route('menu', ['category_name' => $category['slug']]) }}"
                    style="font-weight: 500; font-size: 20px; line-height: 20px;">
                    {{$category['bg_name']}}
                    <sup><i class="small fas fa-external-link-alt"></i></sup>
                </a>
                <ul class="d-none d-md-flex nav nav-tabs border-0" role="tablist" style="margin-bottom: -7px; position: relative; z-index: 1;">
                    <?php $i = 0; ?>
                    @foreach($GLOBALS['dish_default_types'][$category['slug']] as $type)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-0 {{$i===0 ? '_active' : ''}}" id="{{$GLOBALS['dish_types'][$category['slug']][$type['slug']]['slug'].$rand}}-tab" data-bs-toggle="tab" data-bs-target="#{{$GLOBALS['dish_types'][$category['slug']][$type['slug']]['slug'].$rand}}" type="button" role="tab" aria-controls="{{$GLOBALS['dish_types'][$category['slug']][$type['slug']]['slug'].$rand}}" aria-selected="{{$i===0 ? 'false' : 'false'}}">
                                <span class="pb-0 btn btn-s text-uppercase">{{ $GLOBALS['dish_types'][$category['slug']][$type['slug']]['bg_name'] }}</span>
                            </button>
                        </li>
                        <script>
                        $(function() {
                            var tabEl = document.querySelector('button#{{$GLOBALS['dish_types'][$category['slug']][$type['slug']]['slug'].$rand}}-tab')
                            tabEl.addEventListener('show.bs.tab', function (event) {
                                console.log('open tab');
                                $('#{{$category['slug']}}').hide();
                            })
                        })
                        </script>
                        <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
            <div id="{{$category['slug']}}" class="@if($loop->first) first-dishes @else dishes @endif">
                @include('home.category.partials.dishes', ['dish_type' => 'S', 'dishes' => $_dishes])
            </div>
            <div class="tab-content">
                <?php
                if( $_dishes->isNotEmpty() ):
                    $i = 0;
                    foreach($GLOBALS['dish_default_types'][$category['slug']] as $tag) {
                        $tag = $tag['slug'];
                        $_dishes[$tag] = $_dishes->filter(function($item) use ($tag) {
                            if(isset($item['tags'])):
                                foreach($item['tags'] as $this_tag) {
                                    if($this_tag == $tag)
                                        return $item;
                                };
                            endif;
                        });
                    }
                    ?>
                    @foreach($GLOBALS['dish_default_types'][$category['slug']] as $type)
                        <div class="tab-pane" id="{{$GLOBALS['dish_types'][$category['slug']][$type['slug']]['slug'].$rand}}" role="tabpanel" aria-labelledby="{{$GLOBALS['dish_types'][$category['slug']][$type['slug']]['slug'].$rand}}-tab">
                            <!-- @ include('static.category.partials.subheader', ['type' => $type['slug'], 'category_name' => $category['slug']]) -->
                            <div class="dishes">
                                @include('home.category.partials.dishes', ['dish_type' => 'S', 'dishes' => $_dishes->get($type['slug'])->shuffle()])
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                <?php
                endif;
                ?>
            </div>
        </div>
        @endforeach
    </div>

    <script type="text/javascript">
        var slick_settings = {
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
        };
        $(document).ready(function(){
            @foreach($GLOBALS['categories'] as $group => $category)
                @if($loop->first)
                    $('.first-dishes').slick(slick_settings);
                @else
                    setTimeout(()=>{
                        $('.dishes').slick(slick_settings);
                    }, 750)
                @endif
            @endforeach
        });
    </script>

@endsection