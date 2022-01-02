
@if(Session::has('flash-message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> {{Session::get('flash-message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<!-- guests -->

@if($current_user_guest_data)
    <div class="d-flex align-items-center">
        @if($current_user_guest_data['status'] == NULL && $current_user_guest_data['guest_type'] != 'OWNER')
            <h6 class="_font-weight-normal">Твоята роля {{$current_user_guest_data['guest_type']}}</h6>
            <form class="ml-4 m-0 p-0" action="{{ route('reservation-guest-update', ['id' => $current_user_guest_data['id']]) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <input type="hidden" name="status" value="A">

                <button type="submit" class=" btn m-0 btn btn-outline-dark btn-sm">
                    потвърди присъствие <i class="far fa-check-circle"></i>
                </button>
            </form>
        @else
            <i class="mr-1 text-black far fa-check-circle"></i>
            <h6 class="m-0">Твоята роля {{$current_user_guest_data['guest_type']}}</h6>
        @endif
            <form class="ml-4 m-0 p-0" action="{{ route('reservation-guest-delete', ['id' => $current_user_guest_data['id']]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="m-0 px-0 btn btn-link text-dark btn-sm">
                    напусни <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
    </div>
    @if($current_user_guest_data['status'] != NULL)
        @if($current_user_guest_data['notes'])
            <p>$current_user_guest_data['notes']</p>
        @else
            <p>Все още нямаш бележка към резервацията.<a href="#" class="btn btn-link btn-sm">Напиши</a></p>
        @endif
    @endif
@else
<div class>
    <h5 class="_font-weight-normal">
        Все още не си гост в тази резервация
        <a href="#addselfasguest" data-toggle="modal"
            data-target="#addselfasguest" class="btn btn-outline-dark btn-sm">Присъедини се</a>
    </h5>
</div>
@endif

<div class="mt-3">
@if($other_guests_data)
    <h6 class="_font-weight-normal">Гости:</h6>
    @foreach($other_guests_data as $guest)
        <div class="d-flex">
            <span>{{$guest['first_name']}} {{$guest['last_name']}}</span>
            @php $guest = $other_guests->where('user_id', $guest['id'])->first() @endphp
            @if($guest['status'] == NULL && $guest['guest_type'] != 'OWNER')
            <form action="{{ route('reservation-guest-delete', ['id' => $guest['id']]) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <input type="hidden" name="user_email">

                <button type="submit" class="text-black-50 btn btn-link btn-sm mx-2 px-2">
                    <i class="fas fa-times"></i>
                </button>
            </form>
            @endif
        </div>
    @endforeach
@endif
</div>
<?php
// dd( $other_guests_data, $current_user_guest_data );
?>

<label class="d-flex justify-content-between justify-content-sm-start align-items-center" for="exampleInputEmail1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    <span class="mr-2">Добави гост към резервацията</span>
    <i class="fas fa-caret-down"></i>
</label>
<div class="collapse" id="collapseExample">
    <form class="" action="{{ route('reservation-guest-new', ['reservation_id' => $reservation['id']]) }}" method="POST">
        @csrf
        
        <input type="hidden" name="guest_order" value="{{ count($other_guests_data)+1 }}">

        @if($reservation['status'] == 3) <fieldset disabled> @endif
            <div class="form-group">
                <input type="email" class="form-control" name="user_email" placeholder="Имейл адрес">
            </div>

            <div class="form-group">
            <button class="btn btn-outline-danger btn-sm " type="submit">
                добави
            </button>
            </div>
        @if($reservation['status'] == 3) </fieldset> @endif
    </form>
</div>

@include('reservation.single.modals.add_self_as_guest')
