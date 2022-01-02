
<div class="container-fluid gallery d-flex-column align-items-end" style="
    overflow: hidden;
">
<div class="container">
    <div class="row justify-content-center">
        <div class="col w-100">
        <label class="_d-none _d-sm-block text-uppercase">
            <small><span class="text-uppercase" style="
        opacity: 10.5;
    ">ресторантите във</span> food<b>book</b></small>
        </label>
        </div>
    </div>
</div>
<div class="row py-3" style="
    box-shadow: inset 0px 0px 15px rgba(0, 0, 0, 0.5);
    background-color: white;

    margin-right: -30px;
    margin-left: -30px;
">
    <div class="col">
    
<div id="gallery" class=" position-relative ">

<style type="text/css" media="screen">
	#gallery {
		/* height: 140px;
		margin-top: -30px; */
		background-color: #fff;
	}
	
	.gallery .owl-item {
		width: 140px;
	}
	.gallery .owl-item  img {
		display: block;
		width: 140px;
/* 		width: 280px; */
	}
</style>
    <div class="wrap_restaurants owl-carousel _border">
    @foreach($restaurants as $restaurant)
        <a href="{{route('restaurant', $restaurant['slug'])}}">
            <img class="item owl-lazy border" src="" alt=""  data-src="{{ Storage::url('images/restaurants/'.$restaurant['slug'].'/main.jpeg') }}">
        </a>
    @endforeach
    </div>

    <script>
    $(document).ready(function() {
        var owl_wrapp_restaurants = $('.wrap_restaurants');
        owl_wrapp_restaurants.owlCarousel({
            autoplay: true,
            nav: false,
            dots: false,
            loop: true,
            autoWidth: true,
            // items: 5,
            lazyLoad: true,
            lazyLoadEager: 1,
            responsiveClass: true,
        })

    })
    </script>
    <style>
    .container-fluid.gallery {
        /* position: fixed; */
        bottom: 0;
    }
    @media screen and (max-width: 414px) {
        .container-fluid.gallery {
            z-index: -1;
        }
    }
    #gallery {
        margin-left:-15px;
        margin-right:-15px;
    }
    .wrap_restaurants {
        /* box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 15px; */
    }
    .wrap_restaurants .item {
        margin-left: 0.5rem !important;
        margin-right: 0.5rem !important;
        height: 115px !important;
        max-height: auto !important;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
    }
    @media screen and (min-width: 1024px) {
        
        
    }
    </style>
</div>


</div>
</div>
</div>
<?php

// dd($restaurants);

