<?php

namespace App\Services;

use App\Traits\ConsumeService;

class ReservationMenuService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.reservations.base_uri');
        $this->user_type_id = 1;
    }

    public function post($data)
    {
        return $this->performRequest('POST', '/menus', $data);
    }

}
