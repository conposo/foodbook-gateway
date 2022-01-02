<?php

namespace App\Services;

use App\Traits\ConsumeService;

class ReservationGuestService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.reservations.base_uri');
        $this->user_type_id = 1;
    }

    public function obtainGuests($id)
    {
        //
    }

    public function post($data)
    {
        return $this->performRequest('POST', '/guest', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PATCH', "/guest/{$id}", $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', "/guest/{$id}");
    }
}
