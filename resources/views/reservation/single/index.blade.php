
@extends('layouts.app')

@section('content')


<?php
// dd($data);
$reservation = $data;
?>

<div class="container mb-3 pt-4 pt-lg-5">
<div class="row">
<div class="col card">

    <h1 class="mt-3 mt-lg-5 pb-2 font-weight-normal w-100 d-flex justify-content-between">
        <div href="#collapseReservation"
            data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseReservation">
            Резервация №{{ $reservation['id'] }} в {{ $restaurant['business_name'] }}
            <span class="position-relative" style="top: -0.5em;">
                <a style="font-size:12px;" class="text-dark" href="{{route('restaurant', $restaurant['slug'])}}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
            </span>
            <i class="d-sm-none fas fa-caret-down"></i>
        </div>
        <div>
            <!-- @ if( true || $isOwner && $reservation['status'] != 2 && $reservation['status'] != 0) -->
            @if( $reservation['status'] == 'pending' || $reservation['status'] == 'approved' )
                <form action="" method="POST">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="declined">
                    <button class="btn btn-sm btn-warning" type="submit">анулирай</button>
                </form>
            @else
                <form action="" method="POST">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="pending">
                    <button class="btn btn-sm btn-warning" type="submit">заяви отново</button>
                </form>
            @endif
        </div>
    </h1>

    <div id="collapseReservation" class="collapse _show d-md-block">
        @include('reservation.partials.summary_panel')
        @include('reservation.single.partials.guests')
    </div>
    
    <div class="mb-5"></div>
    
    @if($current_user_guest_data)
        @include('reservation.single.partials.menu')
    @else
        <!-- <p>Все още нямате въведени ястия.
            <a class="mt-2 btn btn-outline-dark btn-sm" href="#"
                data-toggle="modal"
                data-target="#showCategories">добави</a>
        </p> -->
    @endif

    <?php
    // @include('layouts.partials.show-restaurant-categories', ['restaurant' => $restaurant])
    ?>

</div>
</div>
</div>

@include('reservation.single.modals.restaurant_menu')

@include('reservation.single.modals.change_total_guests')

<style>
h1 {
    font-size: 24px;
}

td {
    white-space: nowrap;
}
.date {
    color: brown;
    font-size: 14px;
    white-space: nowrap;
}
@media (min-width: 768px) {
    h1 {
        font-size: 48px;
    }
}
</style>


@endsection
