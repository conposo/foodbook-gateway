
@extends('layouts.app')

<?php
// dd($data);
?>

@section('content')

<div class="container">
<div class="row">
    <div class="mx-auto mt-5 col-12 col-md-10 col-lg-8 col-xl-5">
        <div class="">
            <h4 class="mb-3 font-weight-normal text-center">
                Списък с продукти за месец {{$GLOBALS['month_formatted']}}
            </h4>

            @if(isset($data) && $data)

                <?php
                $checked = [];
                $unchecked = [];
                ?>
                @foreach($data['personal_items'] as $ingredient)
                <?php
                ( isset($ingredient['checked']) && $ingredient['checked'] == 1 ) ? $checked[] = $ingredient : $unchecked[] = $ingredient;
                ?>
                @endforeach
                
                <p class="mb-3 text-center">За лично ползване</p>

                @include('list.partials.print_list')
                @include('list.modals.change-quantity')

                <div class="my-5"></div>

                @if(isset($data['household_items']))
                    <?php
                    $checked = [];
                    $unchecked = [];
                    ?>
                    @foreach($data['household_items'] as $ingredient)
                    <?php
                    ( isset($ingredient['checked']) && $ingredient['checked'] == 1 ) ? $checked[] = $ingredient : $unchecked[] = $ingredient;
                    ?>
                    @endforeach
                    
                    <p class="mb-3 text-center">За домакинството</p>

                    @include('list.partials.print_list')
                    @include('list.modals.change-quantity')

                    <div class="my-5"></div>
                @endif
                <!-- @ include('list.partials.user-add-list-to', ['data' => $list]) -->
                
                <div class="text-center mt-3">
                    <a href="#" class="btn btn-outline-dark">Поръчай от магазина</a>
                </div>

                <!-- <div> <a href="" class="btn">add more items</a> </div> -->

                <!-- @ include('list.partials.print_weekly_list') -->
            @else
                <p class="text-center">Този списък е все още празен</p>
                <!-- nothing added to this Weekly list
                lets build something great!
                go and add some ingredients
                see how -->
            @endif
            
        </div>

    </div>
</div>
</div>

@endsection