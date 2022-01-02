
@extends('layouts.app')

@section('content')

<style>
th > span, td > span {
    white-space: nowrap;
}
</style>
<div class="container pt-5">
<div class="row">
<div class="col card pt-3">

    <h1 class="h3 mb-3 font-weight-normal">
        Моите резервации
    </h1>

    <table class="table table-responsive-md border">
        <tr>
            <th><span>ID</span></th>
            <th><span>Ресторант</span></th>
            <th><span>Дата/час</span></th>
            <th><span>Статус</span></th>
            <th><span></span></th>
        </tr>
        <?php
        foreach($data as $reservation_data):
        ?>
            <tr>
                <td><a href="{{route('reservation', $reservation_data['id'])}}">{{ $reservation_data['id'] }}</a></td>
                <td>
                    <?php
                    // dd($restaurants, $reservation_data['restaurant_id']);
                    $restaurant = $restaurants->where('id', $reservation_data['restaurant_id'])->first();
                    // $reservation_array = $restaurant_reservations->where('reservation_id', $reservation_data['id'])->first();
                    // $restaurant_id = $reservation_restaurants_id[$reservation_data['id']];
                    // $restaurant_data = $restaurants_data->find($restaurant_id);
                    ?>
                    <a class="text-dark" href="{{route('restaurant', '')}}" target="_blank">
                        {{$restaurant['business_name']}}
                        <small class="position-relative" style="top: -0.5em;">
                            <i class="fas fa-external-link-alt"></i>
                        </small>
                    </a>
                </td>
                <td>{{ $reservation_data['date'] }} / {{ $reservation_data['time'] }}</td>
                <td>{{ ($reservation_data['status'] == 'pending') ? 'непотвърдена' : $reservation_data['status'] }}</td>
                
                <td>
                    <a class="btn btn-lg my-0 py-0" href="{{route('reservation', $reservation_data['id'])}}"><i class="fas fa-sign-in-alt"></i></a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>

    

    <!-- // add guests

    // choose dishes -->

</div>
</div>
</div>
@endsection
