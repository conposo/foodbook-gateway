
    <section id="gallery" class="position-relative d-flex align-items-center">
        <style>
        #gallery {
            height: calc(100vh);
        }

        @media screen and (min-width: 1024px) {
            
        }
        </style>

        <div class="d-flex-column w-100 position-relative border p-1"
                style="
                box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 15px;">
            <div class="wrapp_dishes owl-carousel">
            @foreach($dish_pictures as $recipe_picture)
                @if($recipe_picture[1] != 'main.jpeg')
                <div class="item owl-lazy"
                    style="height: 215px !important;
                        max-height: auto !important;
                        padding: 200px 5px;
                        background-size: cover;
                        background-position: center;
                        border: 0px solid grey;
                        _opacity: 1 !important;
                        _box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 15px"
                    data-src="{{ Storage::url('images/dishes/'.$recipe_picture[0].'/'.$recipe_picture[1]) }}" >
                </div>
                @endif
            @endforeach
            @foreach($dish_pictures as $recipe_picture)
                @if($recipe_picture[1] == 'main.jpeg')
                <div class="item owl-lazy" style="height: 215px !important;
                                        max-height: auto !important;
                                        padding: 200px 5px;
                                        background-size: cover;
                                        background-position: center;
                                        border: 0px solid grey;
                                        _opacity: 1 !important;
                                        _box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 15px"
                        data-src="{{ Storage::url('images/dishes/'.$recipe_picture[0].'/'.$recipe_picture[1]) }}" >
                </div>
                @endif
            @endforeach
            </div>

            <style>
            .gallery_nav {
            }
            @media screen and (max-width: 767px) {
                .gallery_nav {
                    width: 100%;
                }
                .gallery_nav .prev {
                    margin-right: 10px;
                }
            }
            </style>
            <div class="position-absolute gallery_nav owl-custom-nav d-flex justify-content-center justify-content-md-between align-items-center mt-3">
                <a class="owl-go prev">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a class="owl-go next text-right">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <a class="d-none d-md-block next-section position-absolute text-dark rr2" href="#" onclick="$('.rr2').hide()">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>