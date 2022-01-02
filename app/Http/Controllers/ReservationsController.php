<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

use App\Services\ReservationService;
use App\Services\RestaurantService;

class ReservationsController extends Controller
{
    protected $reservationService;
    protected $restaurantService;

    public function __construct(ReservationService $reservationService, RestaurantService $restaurantService)
    {
        $this->reservationService = $reservationService;
        $this->restaurantService = $restaurantService;
        // $this->user_id = 1;
    }

    public function index()
    {
        $this->user_id = Auth::id();

        $data = $this->reservationService->obtainReservations($this->user_id);
        $data = json_decode($data, true);
        $restaurant_ids = array_values(collect($data['data'])->pluck('restaurant_id', 'id')->toArray());
        $restaurants = $this->restaurantService->obtainByIDs($restaurant_ids);
        $data['restaurants'] = collect(json_decode($restaurants, true)['data']);
        // dd($data['restaurants']);
        // dd($data);
        return view('reservation.all.index', $data);
    }
    
    public function show($id)
    {
        $this->user_id = Auth::id();
        if($reservation = $this->reservationService->obtainReservation($id))
        {
        }
        $reservation = json_decode($reservation, true);

        $reservation_guests = collect($reservation['data']['guests']);
        $reservation['current_user_guest_data'] = $reservation_guests->where('user_id', $this->user_id)->first();

        if((int)$reservation['data']['creator_id'] == $this->user_id || $reservation['current_user_guest_data'])
        {
            $user_id = $this->user_id;
            $other_guests = $reservation_guests->filter(function ($value, $key) use ( $user_id ){
                return $value['user_id'] != $user_id;
            });
            $reservation['user'] = Auth::user();
            $other_guests_ids = $other_guests->pluck('user_id')->toArray();
            $other_guests_data = User::find($other_guests_ids);
            $reservation['other_guests'] = collect($other_guests);
            $reservation['other_guests_data'] = $other_guests_data->toArray();
    
            $restaurant = $this->restaurantService->obtainByIDs([$reservation['data']['restaurant_id']]);
            // $restaurant = $this->restaurantService->obtainByIDs([1]);
            
            $reservation['restaurant'] = collect( json_decode($restaurant, true)['data'] )->first();
            // dd($reservation['current_user_guest_data']);
            return view('reservation.single.index', $reservation);
        }
        else return redirect()->route('home');
    }

    public function store(Request $request)
    {
        $this->user_id = Auth::id();
        
        $request['date'] = date( "Y-m-d", strtotime($request->date) );
        $request['status'] = 'pending';
        $request['creator_id'] = $this->user_id;
        $request['time'] = $request['hour'].':'.$request['minutes'];
        if($request['user_id'])
        {
            $request['user_id'] = (int) $request['user_id'];
            $data = $request->except('_token', 'hour', 'minutes');
        }
        else
        {
            $data = $request->except('_token', 'hour', 'minutes', 'user_id');
        }
        // dd($data, $request->all(), $request['user_id']);
        $new_reservation = $this->reservationService->post($data);
        $data = json_decode($new_reservation, true);
        // dd($data['data']['id']);

        return redirect()->route('reservation', $id = $data['data']['id']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $reservation = $this->reservationService->update($data, $id);
        if((bool)$request->back)
        {
            return back();
        }
        return redirect()->route('reservation', $id);
    }
}
