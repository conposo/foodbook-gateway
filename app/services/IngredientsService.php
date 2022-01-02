<?php

namespace App\Services;

use App\Traits\ConsumeService;

class IngredientsService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.ingredients.base_uri');
    }

    public function all()
    {
        return $this->performRequest('GET', 'ingredients');
    }

}