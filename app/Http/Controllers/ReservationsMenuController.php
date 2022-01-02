<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Services\ReservationGuestService;
use App\Services\ReservationService;
use App\Services\RestaurantService;

class ReservationsMenuController extends Controller
{
    protected $reservationGuestService;
    protected $reservationService;
    protected $restaurantService;

    public function __construct(Request $request, ReservationGuestService $reservationGuestService, ReservationService $reservationService, RestaurantService $restaurantService)
    {
        $this->reservationGuestService = $reservationGuestService;
        $this->reservationService = $reservationService;
        $this->restaurantService = $restaurantService;
    }

    public function store(Request $request, $id)
    {
        // dd($request->session_guest_number);
        $guest = $request->guest;
        $data = $request->except('_token', 'guest', 'session_guest_number', 'fullscreen');
        // dd($data);
        if($guest)
        {
            // create new guest
            $data['guest_type'] = 'GUEST';
            $data['reservation_id'] = $id;
            $data['guest_order'] = $guest;
            // dd($data);
            $new_guest = $this->reservationGuestService->post($data);
            $new_guest = json_decode($new_guest, true)['data'];
            // dd($new_guest);
            $data['guest_id'] = $new_guest['id'];
        }

        $reservation = $this->reservationService->addDish($data);
        // dd($reservation);

        if($request->session_guest_number):
            Session::flash('guest_order', $request->session_guest_number);
        endif;
        if($request->fullscreen):
            Session::flash('fullscreen', 'true');
        endif;

        if((bool)$request->back)
        {
            return back();
        }
        return redirect()->route('reservation', $id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method', 'fullscreen');
        $reservation = $this->reservationService->updateDish($data);
        
        if($request->session_guest_number):
            Session::flash('guest_order', $request->session_guest_number);
        endif;
        if($request->fullscreen):
            Session::flash('fullscreen', 'true');
        endif;

        if((bool)$request->back)
        {
            return back();
        }
        return redirect()->route('reservation', $id);
    }

    public function destroy(Request $request, $id)
    {
        $data = $request->except('_token', 'fullscreen');
        $reservation = $this->reservationService->removeDish($data);

        if($request->session_guest_number):
            Session::flash('guest_order', $request->session_guest_number);
        endif;
        if($request->fullscreen):
            Session::flash('fullscreen', 'true');
        endif;

        if((bool)$request->back)
        {
            return back();
        }
        return redirect()->route('reservation', $id);
    }
}
