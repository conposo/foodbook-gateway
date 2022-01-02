
@extends('layouts.app')

@section('content')

<style>
    img.rounded-circle {
        width: 50px;
        height: 50px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="pt-5 px-0 mx-auto col-12 col-md-10 col-lg-8 col-xl-6">

    @if(Session::has('store-member'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> {{Session::get('store-member')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif

@if($household->isEmpty())
    @include('household.partials.forms.new-household')
@else
    <?php
    $household = $household->toArray();
    $household_members = collect($household['members']);

    $current_user_household_data = $household_members->where('user_id', $current_user['id'])->first();
    $current_user_type = $current_user_household_data['user_type'];
    $current_user_status = $current_user_household_data['status'];

    $collect_household_members_data = $household_members->where('user_id', '<>', $current_user['id']);
    $household_members_user_ids = $collect_household_members_data->pluck('user_id')->toArray();
    $household_members = $collect_household_members_data->toArray();
    $household_members_user_data = \App\User::find($household_members_user_ids);
    // dd( $household, $household_members, $household_members_user_data );
    ?>
    <div class="mb-3 mb-md-5 px-3 px-md-5 py-2 border" style="background: #f5f6f7;">
        <h1 class="h4 mt-4 mb-5 pb-3 border-bottom text-center text-uppercase">Управление на домакинството</h1>

        <div class="mb-3 mb-md-3">
            @if($current_user_type == 'ORGANIZER') <!-- EDIT Household name -->
                @include('household.partials.edit.index')
            @else
                <h5 class="{{($current_user_status == 'PENDING') ? 'font-weight-normal': 'text-capitalize'}} text-center" style="">
                    @if($current_user_status == 'PENDING')
                        Присъедини се към
                    @endif
                    {{$household['name']}}
                </h5>
            @endif
            <label class="d-none">Ти</label>
            <div class="mb-3 p-2 bg-white border d-flex justify-content-between align-items-top">
                <span class="d-flex align-items-center" style="opacity:{{ ($current_user_status == 'PENDING') ? '0.5' : '' }};">
                    <img class="rounded-circle shadow-sm mr-2" src="https://www.countryfincas.com/images/testimonial_photos/testimonial_placeholder.jpg" alt="">
                    <span>
                        <h6 class="m-0 h5 font-weight-normal">{{$current_user->first_name}}</h6>
                        <small class="d-block _font-weight-bold" style="font-size: 12px; opacity: 0.5;">{{$current_user_type}}</small>
                    </span>
                </span>
                <div class="d-flex align-items-end flex-column text-right">
                    <div class="zd-none" style="font-size:12px; opacity:0.5;">
                        <i class="fas fa-user"></i>
                    </div>
                    @if($current_user_status == 'ACTIVE')
                    <form class="mt-auto p-0 text-right" action="{{route('household-member-remove')}}" method="POST" style="font-size:12px; opacity:0.5;">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="id" value="{{$current_user_household_data['id']}}">

                        <button type="submit" class="p-0 btn btn-sm" style="background-color: _#4267b2;border-color: _#4267b2;">Напусни <i class="fas fa-sign-out-alt"></i></button>
                    </form>
                    @endif
                </div>
            </div>
            @if($household_members)
                <label>Други членове</label>
                @foreach($household_members as $member)
                    @if($member['status'] != 'DECLINED')
                    <div class="mb-3 p-2 bg-white border d-flex justify-content-between align-items-top">
                        <span class="d-flex align-items-center" style="opacity:{{ ($member['status'] == 'PENDING') ? '0.5' : '' }};">
                            <img class="rounded-circle shadow-sm mr-2" src="https://www.countryfincas.com/images/testimonial_photos/testimonial_placeholder.jpg" alt="">
                            <span class="d-flex-column">
                                <h6 class="m-0 h5 font-weight-normal">{{$household_members_user_data->where('id', $member['user_id'])->first()->first_name.' '.$household_members_user_data->where('id', $member['user_id'])->first()->last_name}}</h6>
                                <small class="d-block _font-weight-bold" style="font-size: 12px; opacity: 0.5;">{{ ($member['status'] == 'PENDING') ? $member['user_type'].' '.$member['status'] : $member['user_type'] }}</small>
                            </span>
                        </span>
                        @if($member['user_type'] != 'ORGANIZER' && $current_user_type == 'ORGANIZER')
                        <form action="{{route('household-member-remove')}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="id" value="{{$member['id']}}">

                            <button class="d-block btn p-0" style="font-size: 12px; opacity: 0.5;">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @else
                        <div style="font-size: 12px; opacity: 0.5;">
                            <i class="fas fa-user"></i>
                        </div>
                        @endif
                    </div>
                    @endif
                @endforeach
            @else
                <p class="text-center">Все още няма добавени членове</p>
            @endif
            @if($current_user_status == 'PENDING')

            <?php
            // dd($current_user_household_data['id']);
            ?>
            <div class="mb-3 p-2 d-flex justify-content-center align-items-top">
                <form action="{{route('household-member-remove')}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" value="{{$current_user_household_data['id']}}">
                    
                    <button type="submit" class="btn btn-link btn-sm text-dark mr-2" style="">Откажи</button>
                </form>
                <form class="" action="{{route('household-member-update', ['member_id' => $current_user_household_data['id']])}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="ACTIVE">
                    <button type="submit" class="btn btn-sm btn-primary mr-2" style="background-color: #4267b2;border-color: #4267b2;">Приеми</button>
                </form>
            </div>
            @endif
        </div>
    </div>

    @if($current_user_status != 'PENDING')
        @include('household.partials.forms.add-member')
    @endif

@endif <!-- END Household -->

<?php
/***
 *** OTHER HOUSEHOLDS
 ***/
?>
@if(false && isset($other_households))
 
<div class="mb-3 mb-md-5 px-3 px-md-5 py-2 border" style="background: #f5f6f7;">
    <?php
    foreach($other_households as $other_household_id => $other_household) :
        ($other_household = $other_household->first());
    ?>
        @php($current_user_status = $other_household_members_current_user[$other_household_id]['status'])
        @php($current_user_type = $other_household_members_current_user[$other_household_id]['type'])
        <?php
        // dd($current_user_status);
        ?>
        <div class="mt-5 mb-3"  style="opacity:{{ ($current_user_status == 'PENDING') ? '0.5' : '' }};">
            <h5 class="mb-3 text-uppercase text-center">{{ ($current_user_status == 'PENDING') ? 'Гостувай' : 'Гостуваш' }} на {{$other_household->name}}</h5>
            @if($other_household_members_data[$other_household_id])
                <label for="">Членове</label>
                @foreach($other_household_members_data[$other_household_id] as $member)
                    @if($member['status'] != 'PENDING' && $member->id != $current_user->id)
                    <div class="mb-3 p-2 bg-white border d-flex justify-content-between align-items-top"
                        style="background-color: white !important;">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle mr-2" src="https://scontent-sof1-1.xx.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=103&_nc_ht=scontent-sof1-1.xx&oh=a5a5cb6618e115000ab9787f3c49f459&oe=5C7E26E9" alt="">
                            <span class="d-flex-column">
                                <h6 class="m-0 h5 font-weight-normal">{{$member->first_name.' '.$member->last_name}}</h6>
                            </span>
                        </span>
                        <div style="font-size: 12px; opacity: 0.5;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="w-100 form-group">
            @if($current_user_status == 'PENDING')
                <div class="mb-3 p-2 d-flex justify-content-center align-items-top">
                    <form action="{{route('household-decline', ['household_id' => $other_household_id, 'type' => $current_user_type])}}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-link text-dark mr-2" style="">Откажи</button>
                    </form>
                    <form action="{{route('household-join', ['household_id' => $other_household_id, 'type' => $current_user_type])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary" style="background-color: #4267b2;border-color: #4267b2;">Присъедини се</button>
                    </form>
                </div>
            @else
                <form class="text-right" action="{{route('household-leave', ['household_id' => $other_household_id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #4267b2;border-color: #4267b2;">Напусни</button>
                </form>
            @endif
        </div>
    <?php
    endforeach;
    ?>
</div>
@endif

        </div>
    </div>
</div>
<?php
// if not has HH
    // create one
// else
    // add member
?>
@endsection
