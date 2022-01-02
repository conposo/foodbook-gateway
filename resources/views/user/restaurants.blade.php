@extends('layouts.app')

@section('content')

    <div class="container mx-auto">

        @if( !empty($restaurants_data) )
        <div class="card p-3">
            <h2 class="mb-3">Твоите ресторанти</h2>

            <script>
            $(document).ready(function(){
                $('.restaurant_row').hover(function(){
                    $(this).addClass('bg-light')
                }, function(){
                    $(this).removeClass('bg-light')
                })
            })
            </script>

            @foreach($restaurants_data as $restaurant)
            <div class="restaurant_row my-0 px-1 py-2 d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <a class="ml-1 text-dark" target="_blank" href="{{ route('restaurant', $restaurant['slug'] ) }}">
                        <span class="border-right pr-1">{{ $loop->index }}</span>
                        <span class="border-right pr-1">{!! $restaurant['city'] !!}</span>
                        &nbsp;
                        <span class="pl-1">{!! $restaurant['business_name'] !!}</span>
                        <sup>
                            <small>
                                <i class="fas fa-external-link-alt"></i>
                            </small>
                        </sup>
                    </a>
                </div>
                <div>
                    <a class="ml-2" href="{{ route('restaurant-settings', $restaurant['slug'] ) }}"><i class="fas fa-cogs"></i></a>
                    <!-- <a class="ml-2" href="route('restaurant-edit', $restaurant['slug'] ) }}"><i class="far fa-edit"></i></a> -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="card p-3 my-4 pt-3">
            <h1 class="font-weight-normal">
                Впиши ресторант във 
                <span class="">
                    <span style="font-weight:300;">food</span><span style="font-weight:500;">book</span>
                </span>
            </h1>

            <div class="d-flex">
                <a href="#">Прочети пълните условия</a>
                <span class="mx-1">и после</span>
                <a href="{{route('restaurant-new')}}" target=_blank>цъкни тук</a>
            </div>
        </div>
    
    </div>

@endsection
