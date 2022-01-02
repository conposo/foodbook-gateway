
@extends('layouts.app')

@section('content')

<?php
$dish = $data;
// dd($dish);
?>

<div itemscope itemtype="http://schema.org/Recipe" class="container">
    <meta itemprop="recipeCategory" content="{{$GLOBALS['categories'][$dish['category']]['bg_name']}}">
    <div class="row">
        <div class="col">
        <!-- <div class="mx-auto col-12 col-md-10 col-lg-8 col-xl-6"> -->

            @include('static.dish.modules.intro')

            @if(!empty($data['restaurants']))
                @include('static.dish.modules.restaurants')
            @endif

            @include('static.dish.modules.pictures.print')

            <?php
            // dd( $dish['recipe'] );
            ?>

            @include('static.dish.modules.recipe')

            <section class="fixed-bottom" style="background-color: floralwhite;">
                <header class="d-none pb-1 border-bottom">
                    <h3 class="mb-0 pl-3 _text-center font-weight-normal"
                        style="font-size:14px; font-style:_italic; font-weight:400!important;">Добави <b>{{ $dish['bg_name'] }}</b></h3>
                </header>
                <span class="position-absolute" >{{ $dish['bg_name'] }}</span>
                <div class="d-flex justify-content-center align-items-center position-relative" style="z-index:1; box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);">
                    <button class="btn btn-link text-dark" data-toggle="modal" data-target="#addDishModal" title="Добави {{ $dish['bg_name'] }} за ">
                        <span style="font-size:3.6rem; line-height:5rem; font-weight:100;">+</span>
                    </button>
                </div>
            </section>

        </div>
    </div>
</div>

@include('static.dish.modals.add_dish')

<script>
    $(document).ready(function(){
        jQuery.fn.extend({
            scrollTo : function(speed, easing) {
                return this.each(function() {
                    var targetOffset = $(this).offset().top;
                    $('html,body').animate({scrollTop: targetOffset}, speed, easing);
                });
            }
        });
        $('.next-section').click(function(e){
            e.preventDefault();
            var $this = $(this),
                $next = $this.parent().next();
                console.log($next);
            
            $next.scrollTo(1400);
        });
        $('.prev-section').click(function(e){
            e.preventDefault();
            var $this = $(this),
                $prev = $this.parent().prev();

            $prev.scrollTo(1400);
        });
    });
</script>
<style>
.fixed-bottom > .position-absolute {
    z-index: 0;
    top:10px;

    background-color: rgba(0, 0, 0, 0);
    box-sizing: border-box;
    color: rgba(0, 0, 0, 0.75);
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;

    font-family: cheque-black;

    font-size: 28px;
    font-weight: 800;
    line-height: 34px;
    margin-left: 15px;
    margin-right: 15px;
    opacity: 0.15;
    text-align: left;
    text-decoration: none;
    text-decoration-color: rgba(0, 0, 0, 0.5);
    text-decoration-line: none;
    text-decoration-style: solid;
    text-transform: uppercase;
}

@media screen and (min-width: 475px) {
    .fixed-bottom > .position-absolute {
        top: calc( 50% - 20px );

        font-size: 42px;
        line-height: 50.4px;

        margin-bottom: -25px;
    }
}
</style>

<meta property="og:url"                content="{{ Storage::url('images/dishes/'.$dish['slug']) }}" />
<meta property="og:title"              content="{{ $dish['bg_name'] }} в {{ ucfirst($GLOBALS['categories'][$dish['category']]['bg_name']) }}" />
<meta property="og:description"        content="{{ $dish['description'] }}" />
<meta property="og:image"              content="{{ Storage::url('images/dishes/'.$dish['slug'].'/main.jpeg') }}" />
<meta property="og:locale"             content="bg_BG" />
@endsection