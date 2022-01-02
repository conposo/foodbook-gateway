
@extends('layouts.app')

<?php
// dd($data);
?>

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="mx-auto mb-5 col-12 col-md-10 col-lg-8 col-xl-5">

            <div class="">
                <h4 class="mb-5 font-weight-normal text-center">
                    <div>
                        <small>Списък с продукти за</small>
                        <small style="">{{$GLOBALS['day_formatted']}}</small>
                    </div>
                    <small class="mt-1 d-block" style="color: brown;font-size:12px">{{$GLOBALS['day']}} {{$GLOBALS['month_formatted']}} / {{$GLOBALS['year']}}г.</small>
                </h4>
                
                @if($data)


                    @if(isset($data['personal_items']))
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
                    @endif

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

                    <!-- @ include('list.partials.user-add-list-to') -->

                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-outline-dark">Поръчай от магазина</a>
                    </div>
                @else
                    <p class="text-center">Този списък е все още празен</p>
                @endif
            </div>

        </div>
    </div>
</div>

@if($data)


    <?php
    // dd($item);
    ?>


@else
    <!-- nothing added to this Daily list
    lets build something great!
    go and add some ingredients
    see how -->
@endif

@endsection