
@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col card">
            
            <div class="my-4 h4 d-flex justify-content-between align-items-center">        
                <span>Настройки</span>
            </div>

<?php
// dd($user_data->positions->toArray());
if ($user_data->hasVerifiedEmail()) {
    ?>

    <?php
}
else
{
    ?>

    <?php
}
?>
            <div class="">
                <div class="border-bottom d-flex justify-content-start between align-items-center">
                    <i class="fas fa-user-circle mb-1 mr-2"></i>
                    <h5 class="mb-1 font-weight-normal">Лична информация и поверителност</h5>
                </div>

                <div class="-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="mt-2 mb-1">Твоята лична информация</h5>
                    <p class="">
                        <!-- Manage this basic information — your name, email, and phone number — to help others find you on Google products like Hangouts, Gmail, and Maps, and make it easier to get in touch. -->
                        Управлявай твоята основна информация от тук
                        - твоите имена, имейл, и телефонен номер
                        за да помогнеш на другите да те намерят във food<b>book</b> и да е по-лесно да се свържат с теб.
                    </p>

                    <!-- снимка -->

                    <form class="mb-5" action="" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="py-2 border-bottom">
                            <a class="d-flex w-100 justify-content-between align-items-center text-dark"
                                data-toggle="collapse" href="#collapse{{ str_replace(' ', '', $user_data->first_name) }}" role="button" aria-expanded="false" aria-controls="collapse{{ str_replace(' ', '', $user_data->name) }}">
                                <div title="{{$user_data->id}}">
                                    <span class="label">Име:</span>
                                    <b>{{$user_data->first_name}}</b>
                                    <b>{{$user_data->last_name}}</b>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <div class="collapse" id="collapse{{ str_replace(' ', '', $user_data->first_name) }}">
                                <input class="_form-control mt-1 py-0" type="text" name="name" value="{{ $user_data->first_name . ' ' . $user_data->last_name }}">
                            </div>
                        </div>

                        <div class="py-2 border-bottom">
                            <span class="d-flex w-100 justify-content-between align-items-center text-dark"
                                data-toggle="collapse" href="#collapse{{ str_replace(array('@', '.'), '', $user_data->email) }}" role="button" aria-expanded="false" aria-controls="collapse{{ str_replace(array('@', '.'), '', $user_data->email) }}">
                                <div>
                                    <span class="label">Имейл:</span>
                                    <b>{{$user_data->email}}</b>
                                    @if($user_data->hasVerifiedEmail())
                                    <button type="button" class="btn btn-xs btn-outline-dark px-1 py-0" style="
    opacity: 0.5;
    line-height: 1;
    font-size: 0.7rem;
    padding-bottom: 3px !important;
">потвърден</button>
                                    @else
                                    <button type="button" class="btn btn-xs btn-outline-dark px-1 py-0" style="
    opacity: 0.5;
    line-height: 1;
    font-size: 0.7rem;
    padding-bottom: 3px !important;
">непотвърден</button>
                                    <a class="btn btn-link p-0 _text-danger" style="
    line-height: 1;
    font-size: 0.7rem;
" href="{{ route('verification.resend') }}">{{ __('изпрати нова заявка за потвърждение') }}<sup><small><i class="ml-1 text-dark fas fa-external-link-alt"></i></small></sup></a>
                                    @endif
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <div class="collapse" id="collapse{{ str_replace(array('@', '.'), '', $user_data->email) }}">
                                <input class="_form-control mt-1 py-0" type="text" name="email" value="{{ $user_data->email }}">
                            </div>
                        </div>

                        <div class="py-2 border-bottom">
                            <a class="d-flex w-100 justify-content-between align-items-center text-dark"
                                data-toggle="collapse" href="#collapse{{ str_replace(array('@', '.'), '', $user_data->phone) }}" role="button" aria-expanded="false" aria-controls="collapse{{ str_replace(array('@', '.'), '', $user_data->phone) }}">
                                <div>
                                    <span class="label">Телефон:</span>
                                    <b>{{$user_data->phone}}</b>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <div class="collapse" id="collapse{{ str_replace(array('@', '.'), '', $user_data->phone) }}">
                                <input class="_form-control mt-1 py-0" type="text" name="phone" value="{{ $user_data->phone }}">
                            </div>
                        </div>

                        <!-- <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                            <span class="label">Телефон</span>
                            
                            <a href="#" class="edit btn btn-link pr-0"><i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                            <span class="label">Рожден ден <sup><i class="fas fa-info-circle"></i></sup></span>
                            
                            <a href="#" class="edit btn btn-link pr-0"><i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                            <span class="label">Пол  <sup><i class="fas fa-info-circle" title="При нужда, преди да продължите се погледнете в огледалото - голи, а не 'сърцето ви' да отговаря за вашият биологичен пол"></i></sup></span>
                            
                            <a href="#" class="edit btn btn-link pr-0"><i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                            <span class="label">За мен  <sup><i class="fas fa-info-circle"></i></sup></span>
                            
                            <a href="#" class="edit btn btn-link pr-0"><i class="fas fa-chevron-right"></i></a>
                        </div> -->

                        <div id="setlocation_position" class="mt-3 py-2 d-flex justify-content-end align-items-center">
                            <button class="btn btn-outline-dark py-0" type="submit">Запиши</button>
                        </div>
                    </form>

                    <style>
                        .switch {
                        position: relative;
                        display: inline-block;
                        width: 60px;
                        height: 34px;
                        }

                        .switch input { 
                        opacity: 0;
                        width: 0;
                        height: 0;
                        }

                        .slider {
                        position: absolute;
                        cursor: pointer;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: #ccc;
                        -webkit-transition: .4s;
                        transition: .4s;
                        }

                        .slider:before {
                        position: absolute;
                        content: "";
                        height: 26px;
                        width: 26px;
                        left: 4px;
                        bottom: 4px;
                        background-color: white;
                        -webkit-transition: .4s;
                        transition: .4s;
                        }

                        input:checked + .slider {
                        background-color: #2196F3;
                        }

                        input:checked + .slider:before {
                        -webkit-transform: translateX(0px);
                        -ms-transform: translateX(0px);
                        transform: translateX(0px);
                        }

                        input + .slider:before {
                        -webkit-transform: translateX(26px);
                        -ms-transform: translateX(26px);
                        transform: translateX(26px);
                        }

                        /* Rounded sliders */
                        .slider.round {
                        border-radius: 34px;
                        }

                        .slider.round:before {
                        border-radius: 50%;
                        }
                    </style>


                    <!-- Location settings -->
                    <div class="border-bottom d-flex justify-content-start -between align-items-center _mb-5">
                        <i class="fas fa-globe-americas mb-1 mr-2"></i>
                        <h5 class="mb-1 font-weight-normal">Настройки за местоположение</h5>
                    </div>
                    @include('user.partials.location')
                    <div class="my_loader d-none"><img src="https://1.bp.blogspot.com/-tM8Z7VPNn5Q/WMkr9sb6qyI/AAAAAAAAA9s/IjGPg8VFOkc41UWeaWuGY7eyJeCCEb82gCLcB/s1600/earth%2B.gif" alt=""></div>
                    <style>
                        .my_loader {
                            position: fixed;
                            top: 0;
                            right: 0;
                            bottom: 0;
                            left: 0;
                            z-index: 9999;
                            background-color: rgba(0, 0, 0, 0.75);
                            background-color: white;
                        }

                        .my_loader img {
                            display: block;
                            margin:auto;
                            /* position: absolute;
                            top: 0;
                            right: 0;
                            bottom: 0;
                            left: 0; */
                            width: auto;
                            max-width: 100%;
                            height: auto;
                        }

                        ._bg {
                            /* background-color: rgba(222, 226, 230, 0.35); */
                        }
                        ._mb-5 {
                            @if(isset($_GET['location']))
                            margin-bottom: 15px;
                            @endif
                        }
                        .set_location {
                            box-shadow: -5px 5px 80px rgb(179, 171, 138);
                            transform: scale(1.05);
                        }
                        @media screen and (max-width: 768px) {
                            ._mb-5 {
                                margin-bottom: 30px;
                            }
                            .set_location {
                                transform: scale(1.15);
                            }
                            ._w-100 {
                                width: 100%;
                            }
                            ._label {
                                font-size: 0.85rem;
                            }
                        }
                    </style>
                    @include('user.modals.set_location')



                    <div class="border-bottom d-flex justify-content-start between align-items-center">
                        <i class="fas fa-user-tie mb-1 mr-2"></i>
                        <h5 class="mb-1 font-weight-normal">Професионални отношения</h5>
                    </div>
                    <div>
                        <?php
                        $positions = $user_data->positions->toArray();
                        $positions_bg = [
                            'foodbook_chef' => 'Foodbook Chef',
                            'CHEF' => 'Главен готвач',
                            'CHEF2' => 'Помощник готвач',
                            'CHEF3' => 'Помощник кухня',
                            'MANAGER' => 'Управител',
                            'BARRISTA' => 'Барман',
                            'WAITER' => 'Сервитьор',
                            'WAITER2' => 'Помощник сервитьор',
                        ];
                        ?>
                        @if( $positions )
                            @foreach($positions as $position)
                                <span class="mr-2">@if(isset($positions_bg[$position['position']])) {{$positions_bg[$position['position']]}} @else {{$position['position']}} @endif</span>
                            @endforeach
                            <small class="d-block">
                                <a href="#list_position" role="button" 
                                    data-toggle="collapse" aria-expanded="false" aria-controls="list_position">Промени<i class="ml-1 fas fa-angle-down"></i></a>
                            </small>
                        @else
                            <h5 class="mt-2 mb-1">Впиши работна позиция</h5>
                            <small class="d-block">
                                <a href="#list_position" role="button" 
                                    data-toggle="collapse" aria-expanded="false" aria-controls="list_position">Посочи позициите на които можеш да работиш<i class="ml-1 fas fa-angle-down"></i></a>
                            </small>
                        @endif
                    </div>
                    <div class="collapse" id="list_position">@include('user.modals.list_position')</div>

                    <div class="d-flex py-2 _border-bottom justify-content-between align-items-center">
                        @if(in_array('foodbook_chef', collect($positions)->pluck('position')->toArray()))
                        <span>Ти си foodbook CHEF</span>
                        @else
                        <a class="px-0 btn btn-link text-dark"
                            onclick="$('#listPositions').modal('show')">
                            <i class="fas fa-user-tag"></i>
                            Стани готвач във food<b>book</b>
                            <sup class="d-none d-md-inline-block"><i class="fas fa-info-circle"></i></sup>
                        </a>
                        @endif
                    </div>
                    @include('user.partials.positions')
                    @include('user.modals.be_chef')



                    <div class="my-4 h4 d-flex justify-content-between align-items-center">        
                        <span>Други</span>
                    </div>
                    <div class="">
                        <div class="border-bottom d-flex justify-content-start between align-items-center">
                            <i class="fas fa-briefcase mb-1 mr-2"></i>
                            <h5 class="mb-1 font-weight-normal">За бизнеса</h5>
                        </div>
                        <!-- членове / семейство -->                            
                        <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                            <a href="{{route('restaurants')}}" class="btn btn-link text-dark">
                                <i class="fas fa-utensils"></i>
                                Заведения
                            </a>
                        </div>
                        <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                            <a href="#" class="disabled btn btn-link text-dark">
                                <!-- <i class="fas fa-user-tie"></i> -->
                                <i class="fas fa-user-lock"></i>
                                Аз съм производител
                                <sup class="d-none d-md-inline-block"><i class="fas fa-info-circle"></i></sup>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="d-flex py-2 border-bottom justify-content-between align-items-center">
                        <a href="#" class="btn btn-link text-dark _text-dark">
                            Още - ако си в бранша
                            <sup class="d-none d-md-inline-block">
                            <i class="fas fa-info-circle"
                                title="стани пом.готвач, сервитьор, ОТЗ и други"></i>
                            </sup>
                        </a>
                    </div> -->
                </div> <!-- END -body  -->

            </div>

        </div>
    </div>
</div>

@endsection
