<style>
    .dish a[href] {
        color: rgba(128, 27, 27, .75) !important;
    }
    .dish a:not([href]) {
        color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
    <div id="menu" class="mt-0 5">
        <div class="row py-5 border-top border-bottom" style="
            background-color: #fffaef;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        ">
            <div class="_col _col-12 _col-lg-8 pt-lg-5 px-lg-5 mx-auto">
                <h2 class="mb-5 pb-2 border-bottom text-uppercase font-weight-normal text-center">
                    <span class="btn-sm rounded-0 px-0 text-black-50">сезонно меню</span>
                </h2>

                <?php

                ?>

                @if(isset($restaurant['menu']))
                    <?php
                    $menu_collection = collect($restaurant['menu']);
                    $categories = array_unique($menu_collection->pluck('category_slug')->toArray());
                    // dd($categories, $GLOBALS['categories'], $GLOBALS['_all_categories']);
                    ?>
                    @foreach($GLOBALS['_all_categories'] as $category)
                        <?php
                        // dd( $category['slug'], $categories, in_array($category['slug'], $categories) );
                        if(!isset($category['slug'])) $category['slug'] = $category['category'];
                        ?>
                        @if( in_array($category['slug'], $categories) )
                            <h4 class="d-flex justify-content-center align-items-center mt-5 mb-3 text-uppercase font-weight-normal">
                                <span class="" style="color:brown; font-size: 0.5rem;">
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                </span>
                                <span class="mx-2">{{$GLOBALS['_all_categories'][$category['slug']]['bg_name']}}</span>
                                <span class="" style="color:brown; font-size: 0.5rem;">
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                </span>
                            </h4>
                        <!-- @ else -->
                            <!-- <h5 class="d-flex justify-content-center align-items-center mt-5 mb-3 text-uppercase font-weight-normal">
                                <span class="" style="color:brown; font-size: 0.5rem;">
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                </span>
                                <span class="mx-2">без категория</span>
                                <span class="" style="color:brown; font-size: 0.5rem;">
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                    <i class="fas fa-star-of-life"></i>
                                </span>
                            </h5> -->
                        @endif

                        <?php $dishes = $menu_collection->where('category_slug', $category['slug'])->toArray() ?>
                        
                        @foreach($dishes as $dish)
                        <?php //dd($dish); ?>
                        <div itemscope itemtype="http://schema.org/Product" class="pl-3 d-flex justify-content-center align-items-center position-relative mb-3 rounded dish text-center" style="_background-size:cover; _background-image:url('/images/restaurants/{{ $restaurant['slug'] }}/main.jpeg')">
                            <a itemprop="url" class="d-block _pt-2"
                                @if( ! $dish['is_public'] )    
                                @endif
                                @if( isset($dish['dish_id']) && $dish['dish_id'] && isset($dish['dish_slug']) && $dish['dish_slug'] )
                                href="{{ route('dish', $dish['dish_slug']) }}"
                                @endif
                                >
                                <span class="d-none" style="color: _brown; font-size: 1rem;">- - - - - -</span>
                                <span itemprop="name" class="py-0">{{ $dish['dish_name'] }}</span> -

                                <?php
                                $combined_price =  App\Http\Controllers\Controller::combinePriceParts($dish['dish_price']);
                                // $_price = explode(".", $dish['dish_price']);
                                // var_dump($price);
                                // if(count($price) == 1 && $price[0] === '0') $price = 0; //'0.99';
                                // else
                                // {
                                //     $price = $_price[0];
                                //     if( isset($_price[1]) )
                                //     {
                                //         if(strlen($_price[1]) == 1)
                                //         {
                                //             $price .= ",{$_price[1]}0";
                                //         }
                                //         else $price .= ",{$_price[1]}";
                                //     }
                                //     else $price .= ',00';
                                // }
                                ?>
                                <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    @if( isset($dish['dish_slug']) && $dish['dish_slug'] )
                                    <meta itemprop="url" content="{{ route('dish', $dish['dish_slug']) }}">
                                    @endif
                                    <span itemprop="price" content="{{$combined_price}}" style="color:#636363; font-size:1,2rem; 
    font-weight: 500;
    font-family: cheque-black;
    ">
                                        <link itemprop="availability" href="http://schema.org/InStock" />
                                        {{$combined_price}}
                                        <small itemprop="priceCurrency" content="BGN" style="margin-bottom: -3px;">лв.</small>
                                    </span>
                                </span>
                            </a>
                        </div>
                        @endforeach

                    @endforeach

                    <!-- Non System Categpries -->
                    @foreach($categories as $category)
                        @php
                            $next_category = false;
                        @endphp
                        @foreach($GLOBALS['_all_categories'] as $_category)
                            @if($_category['slug'] == $category)
                            @php
                                $next_category = true;
                            @endphp
                            @endif
                        @endforeach
                        @if($next_category)
                            @php
                                continue;
                            @endphp
                        @endif
                        <h4 class="d-flex justify-content-center align-items-center mt-5 mb-3 text-uppercase font-weight-normal">
                            <span class="" style="color:brown; font-size: 0.5rem;">
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                            </span>
                            <span class="mx-2">{{$category}}</span>
                            <span class="" style="color:brown; font-size: 0.5rem;">
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                            </span>
                        </h4>
                        <?php $dishes = $menu_collection->where('category_slug', $category)->toArray() ?>
                        @foreach($dishes as $dish)
                            <div itemscope itemtype="http://schema.org/Product" class="pl-3 d-flex justify-content-center align-items-center position-relative mb-3 rounded dish text-center" style="_background-size:cover; _background-image:url('/images/restaurants/{{ $restaurant['slug'] }}/main.jpeg')">
                                <span class="a d-block">
                                    <span itemprop="name" class="py-0">{{ $dish['dish_name'] }}</span> -
                                    <?php $combined_price =  App\Http\Controllers\Controller::combinePriceParts($dish['dish_price']); ?>
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        @if( isset($dish['dish_slug']) && $dish['dish_slug'] )
                                        <meta itemprop="url" content="{{ route('dish', $dish['dish_slug']) }}">
                                        @endif
                                        <span itemprop="price" content="{{$combined_price}}" style="color:#636363; font-size:1rem;">
                                            <link itemprop="availability" href="http://schema.org/InStock" />
                                            {{$combined_price}}
                                            <small itemprop="priceCurrency" content="BGN" style="margin-bottom: -3px;">лв.</small>
                                        </span>
                                    </span>
                                </span>
                            </div>
                        @endforeach
                    @endforeach

                @endif
                <?php
                
                ?>
            </div>
        </div>
    </div>