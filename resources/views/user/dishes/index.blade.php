
@extends('layouts.app')

@section('content')

<h5 class="my-3 pb-2 text-center _border-bottom">Рецептурна книжка</h5>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col card py-3">

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                @switch(session('status'))
                    @case('deleted')
                        Изтрихте успешно!
                    @break
                    @case('created')
                        Записахте успешно!
                    @break
                    @case('empty_value')
                        Не се записа! Има непопълнени полета.
                    @break
                    @default
                        Нещо се обърка!
                @endswitch
                </strong>
                <!-- You should check in on some of those fields below. -->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <?php
            // dd($data);
            // $GLOBALS['all_categories'] = $GLOBALS['categories'] + $categories;
            // dd($GLOBALS['categories']);
            ?>
            @include('user.dishes.partials.dishes.categories')
            @include('user.dishes.partials.dishes.dishes')
        </div>

        </div>
    </div>
</div>

@include('user.dishes.modals.add-category')

@endsection