<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RestaurantService;
use App\Services\ReservationService;

class RestaurantReservationsController extends Controller
{
    protected $restaurantService;
    protected $reservationService;

    public function __construct(Request $request, RestaurantService $restaurantService, ReservationService $reservationService)
    {
        $this->restaurantService = $restaurantService;
        $this->reservationService = $reservationService;

        $this->user_id = 1;
        
        if($request->slug)
        {
            $this->restaurant = $this->restaurantService->obtainRestaurant($request->slug);
            $this->restaurant = json_decode($this->restaurant, true)['data'];
            $this->restaurant_id = $this->restaurant['id'];
            // foreach($this->restaurant['categories'] as $restaurant_category)
            // {
            //     $GLOBALS['categories'][$restaurant_category['category']] = $restaurant_category;
            // }
            // $GLOBALS['all_categories'] = $GLOBALS['categories'];
        }
    }

    public function index(Request $request, $slug)
    {
        $data = $this->reservationService->obtainRestaurantReservations($this->restaurant_id);
        $data = json_decode($data, true);
        $reservations = collect($data['data']);
        $data['resrvations'] = $reservations;
        $data['restaurant'] = $this->restaurant;

        if( $reservations->isNotEmpty() )
        {
            // dd( collect($data['data'])->where('date', '>=', '2019-01-17') );
    
            $today = $GLOBALS['today'];
            $this->reservations_waiting = $reservations->where('date', '>=', $today)->where('status', '=', 'pending');
            $this->reservations_approved = $reservations->where('date', '>=', $today)->where('status', '=', 'approved');
            $this->reservations_canceled = $reservations->where('date', '>=', $today)->where('status', '=', 'canceled');
            $this->reservations_declined = $reservations->where('date', '>=', $today)->where('status', '=', 'declined');
            $data['reservations'] = $reservations;
            $data['reservations_waiting'] = $this->reservations_waiting;
            $data['reservations_approved'] = $this->reservations_approved;
            $data['reservations_canceled'] = $this->reservations_canceled;
            $data['reservations_declined'] = $this->reservations_declined;
        }
        else
        {
            $data['reservations'] = [];
            $data['reservations_waiting'] = [];
            $data['reservations_approved'] = [];
            $data['reservations_canceled'] = [];
            $data['reservations_declined'] = [];
        }

        if($request->status)
            $data['status'] = $request->status;
        else
            $data['status'] = 'all';


        // dd($data);
        return view('admin.restaurant.reservations.index', $data);
    }

    public function show($slug, $reservation_id)
    {
        $data = $this->reservationService->obtainReservationByID($reservation_id);
        $data = json_decode($data, true);
        $data['restaurant'] = $this->restaurant;
        // dd($data);
        return view('admin.restaurant.reservations.single.index', $data);
    }

    // public function store(Request $request)
    // {
    //     $request['status'] = 'approved';
    //     $request['creator_id'] = $this->user_id;
    //     $request['restaurant_id'] = $this->restaurant_id;
    //     // dd($request->except('_token'));
    //     $reservation = $this->reservationService->addReservation($request->except('_token'));

    //     $data = json_decode($reservation, true);
    //     dd($data);

    //     return back();
    // }

    public function tables($slug)
    {
        // dd($GLOBALS['date']);
        $data = $this->reservationService->obtainRestaurantTables($this->restaurant_id, $GLOBALS['date']);
        $data = json_decode($data, true);
        $data['restaurant'] = $this->restaurant;
        // dd( $data );
        return view('admin.restaurant.reservations.tables.all.index', $data);
    }

    public function table($slug, $table)
    {
        $data = $this->reservationService->obtainRestaurantTable($this->restaurant_id, $table);
        $data = json_decode($data, true);
        $data['restaurant'] = $this->restaurant;
        // dd( $data );
        return view('admin.restaurant.reservations.tables.single.index', $data);
    }

}
