<?php

namespace App\Services;

use App\Traits\ConsumeService;

class ReservationService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.reservations.base_uri');
        $this->user_type_id = 1;
    }

    public function obtainReservations($user_type_id)
    {
        return $this->performRequest('GET', '/reservations/'.$user_type_id);
    }

    public function obtainReservation($id)
    {
        return $this->performRequest('GET', "/reservation/{$id}");
    }

    public function post($data)
    {
        return $this->performRequest('POST', '/reservation', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PATCH', "/reservation/{$id}", $data);
    }

    public function addDish($data)
    {
        return $this->performRequest('POST', "menu", $data);
    }

    public function updateDish($data)
    {
        return $this->performRequest('PATCH', "menu", $data);
    }

    public function removeDish($data)
    {
        return $this->performRequest('DELETE', "menu", $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Restaurant Admin Services
    |--------------------------------------------------------------------------
    */
    public function obtainRestaurantReservations($restaurant_id)
    {
        return $this->performRequest('GET', "/restaurant/reservations/{$restaurant_id}");
    }
    public function obtainReservationByID($reservation_id)
    {
        return $this->performRequest('GET',  "/reservation/{$reservation_id}");
    }

    /*
    |--------------------------------------------------------------------------
    | Restaurant Tables Services
    |--------------------------------------------------------------------------
    */
    public function obtainRestaurantTables($restaurant_id, $date)
    {
        return $this->performRequest('GET', "/restaurant/tables/{$restaurant_id}/{$date}");
    }

    public function obtainRestaurantTable($restaurant_id, $table)
    {
        return $this->performRequest('GET', "/restaurant/table/{$restaurant_id}/{$table}");
    }

}
