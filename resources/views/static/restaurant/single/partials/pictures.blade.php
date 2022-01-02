<div id="gallery" class="d-flex-column _w-100 position-relative mb-3 mb-md-5 p-1">

    <div class="wrapp_dishes owl-carousel border">
    @foreach($restaurant_pictures as $picture)
        @if($picture[1] != 'cover.jpeg' && $picture[1] != 'main.jpeg')
        <div class="item owl-lazy" data-src="{{ Storage::url('images/restaurants/'.$picture[0].'/'.$picture[1]) }}" >
        </div>
        @endif
    @endforeach
    </div>

    <div class="_position-absolute gallery_nav owl-custom-nav d-flex justify-content-center justify-content-md-between align-items-center mt-3">
        <a class="owl-go prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="owl-go next text-right">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <script>
    $(document).ready(function() {
        var owl_wrapp_dishes = $('.wrapp_dishes');
        owl_wrapp_dishes.owlCarousel({
            //autoplay: true,
            nav: false,
            dots: false,
            loop: false,
            autoWidth: false,
            items: 1,
            lazyLoad: true,
            lazyLoadEager: 1,
            responsiveClass: true,
        })

        $('.owl-go.next').click(function() {
            console.log(4)
            owl_wrapp_dishes.trigger('next.owl.carousel');
        })
        $('.owl-go.prev').click(function() {
            console.log(4)
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl_wrapp_dishes.trigger('prev.owl.carousel', [300]);
        })
    
        // $('.customNextBtn').click(function(){
        //     _id = $(this).attr('id');
        //     $('.'+_id).owlCarousel('destroy').removeClass('owl-carousel');
        // })

    })
    </script>
    <style>
    #gallery {
        margin-left:-15px;
        margin-right:-15px;
    }
    #gallery.zoom {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
    .wrapp_dishes {
        box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 15px;
    }
    .wrapp_dishes .item {
        height: 215px !important;
        max-height: auto !important;
        padding: 200px 5px;
        background-size: cover;
        background-position: center;
        border: 0px solid grey;
    }
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
    @media screen and (min-width: 1024px) {
        .owl-custom-nav {
            position: absolute;
        }
    }

    .owl-custom-nav .owl-go {
        font-size: 28px;
        opacity: 0.5;
        cursor: pointer;
    }

    @media screen and (min-width: 1024px) {
        
        .owl-custom-nav {
            top: calc( 50% - 25px );
            left: -30px;
            width: calc( 100% + 60px );
        }
        
    }
    </style>
</div>