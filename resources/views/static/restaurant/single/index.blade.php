
@extends('layouts.app')

@section('content')
    <?php
    // dd($data);
    $restaurant = $data;

    $days = [
        'monday' => 'понеделник',
        'tuesday' => 'вторник',
        'wednesday' => 'сряда',
        'thursday' => 'четвъртък',
        'friday' => 'петък',
        'saturday' => 'събота',
        'sunday' => 'неделя',
    ];
    ?>

    <style>
    .cover {
        background-image: url('{{ Storage::url('images/restaurants/'.$restaurant['slug'].'/cover.jpeg') }}');
    }
    </style>

    <div itemscope itemtype="http://schema.org/Restaurant" class="container-fluid">
        <meta itemprop="acceptsReservations" content="true">

        <div class="cover position-relative row d-flex justify-content-center align-items-center">
            @if( Storage::url('images/restaurants/'.$restaurant['slug'].'/main.jpeg') )
            @endif
            <img itemprop="image" class="main_image position-relative d-block mx-auto" src="{{ Storage::url('images/restaurants/'.$restaurant['slug'].'/main.jpeg') }}">
        </div>

        <script>
            function ImgLoad(img_link){
                var randomNum = Math.round(Math.random() * 10000);
                var oImg = new Image;
                oImg.src = img_link + "?rand=" + randomNum;
                return oImg;
            }
            // window.onload=ImgLoad();
            
            $(document).ready( function() {
                setTimeout(function(){
                    oImg = ImgLoad('<?= Storage::url('images/restaurants/'.$restaurant['slug'].'/main.jpeg') ?>');
                    oImg.onload = () => {
                        console.log('Image succesfully loaded!');
                    }
                    oImg.onerror = () => {
                        console.log('No network connection or image is not available.');
                        $('.main_image').remove();
                    }
                }, 250);
                setTimeout(function(){
                    oImg = ImgLoad('<?= Storage::url('images/restaurants/'.$restaurant['slug'].'/cover.jpeg') ?>');
                    oImg.onload = () => {
                        console.log('Image succesfully loaded!');
                    }
                    oImg.onerror = () => {
                        console.log('No network connection or image is not available.');
                        $('.cover').height(300);
                        $('.cover').css('background-image', 'url(https://marvel-b1-cdn.bc0a.com/f00000000067087/bdcnetwork.s3.amazonaws.com/s3fs-public/noma1.jpg)')
                    }
                }, 350);
            })
        </script>

        @include('static.restaurant.single.partials.header')

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 pt-lg-5 px-lg-5 mx-auto">
                    @if( $restaurant['description'] )
                        <div class="mb-3 py-3">
                            <p class="my-0 p-1 text-justify p_description position-relative">
                                {{ $restaurant['description'] }}
                            </p>
                            <button type="button" class="btn btn-sm d-block mx-auto show_more_description"
                            onclick="$('.p_description').css('height', 'auto').removeClass('position-relative'); $('.show_more_description').removeClass('d-block').addClass('d-none')">виж повече</button>
                        </div>
                    @endif
                    @if( count($restaurant_pictures) > 2 )
                        @include('static.restaurant.single.partials.pictures')
                    @endif
                </div>
            </div>
        </div>
        <style>
            .p_description.position-relative::after {
                content: '';
                display: block;
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 100%;
                background: -moz-linear-gradient(top, rgba(255,252,244,0) 0%, rgba(255,252,244,1) 100%);
                background: -webkit-linear-gradient(top, rgba(255,252,244,0) 0%,rgba(255,252,244,1) 100%);
                background: linear-gradient(to bottom, rgba(255,252,244,0) 0%,rgba(255,252,244,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00fffcf4', endColorstr='#fffcf4',GradientType=0 );
            }
            .p_description {
                margin-left:-15px; margin-right:-15px;
                height: 170px;
                overflow: hidden;
            }
        </style>

        @include('static.restaurant.single.partials.reservation-order')

        @include('static.restaurant.single.partials.contacts')

        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col-12 col-lg-8 pt-lg-5 px-lg-5 mx-auto">
                    
                    @include('static.restaurant.single.partials.working-hours')
                    
                </div>
            </div>
        </div>

        @include('static.restaurant.single.partials.map')

        @include('static.restaurant.single.partials.lunch')

        @include('static.restaurant.single.partials.menu')

    </div>

    <meta property="og:url"                content="/restaurants/{{$restaurant['slug']}}" />
    <meta property="og:title"              content="{{ $restaurant['business_name'] }}" />
    <meta property="og:description"        content="{{ $restaurant['description'] }}" />
    <meta property="og:image"              content="{{ Storage::url('images/restaurants/'.$restaurant['slug'].'/main.jpeg') }}" />
    <meta property="og:locale"             content="bg_BG" />
@endsection