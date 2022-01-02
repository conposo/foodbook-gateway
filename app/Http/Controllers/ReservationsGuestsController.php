<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ReservationGuestService;

class ReservationsGuestsController extends Controller
{
    protected $reservationGuestService;

    public function __construct(ReservationGuestService $reservationGuestService)
    {
        $this->reservationGuestService = $reservationGuestService;
        $this->user_id = 1;
    }

    public function store(Request $request)
    {
        if( !isset($request->guest_type) ) $request->guest_type = 'GUEST' ;

        $user = \App\User::where('email', $request['user_email'])->first();
        if( is_null($user) ) return back()->with('flash-message','Такъв потребител не съществува!');  

        $data = $request->except('_token', 'user_email');
        $data['guest_type'] = $request->guest_type;
        $data['guest_order'] = $request->guest_order;
        $data['user_id'] = $user->id;
        $new_guest = $this->reservationGuestService->post($data);
        // $data = json_decode($new_guest, true);
        // reservation_id / guest_id / guest_type / user_id
        return back();
    }

    public function update(Request $request, $id)
    {
        if($request->user_email)
        {
            $user = \App\User::where('email', $request['user_email'])->first();
            if( is_null($user) ) return back()->with('flash-message','Такъв потребител не съществува!');  
            $data['user_id'] = $user->id;
        }

        $data = $request->except('_token', 'user_email');
        $reservation = $this->reservationGuestService->update($data, $id);
        // dd($reservation);
        return back();
    }

    public function destroy($id)
    {
        $response = $this->reservationGuestService->delete($id);
        // dd($response);
        return back();
    }
}
