<?php

namespace App\Services;

use App\Traits\ConsumeService;

class ListService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.lists.base_uri');
    }

    public function obtainList()
    {
        // dd( '/list/'.implode('/', func_get_args()) );
        return $this->performRequest('GET', '/list/'.implode('/', func_get_args()).'/1');
    }

    public function obtainWeeklyList()
    {
        return $this->performRequest('GET', '/lists/'.implode('/', func_get_args()));
    }

    public function obtainMonthlyList()
    {
        return $this->performRequest('GET', '/lists/'.implode('/', func_get_args()));
    }

    public function updateList($data)
    {
        // dd($data);
        return $this->performRequest('PUT', "/list/{$data['shopping_list_id']}", $data);
    }

    public function getItems()
    {
        return $this->performRequest('GET', '/items/'.implode('/', func_get_args()));
    }

    public function postItem($data)
    {
        return $this->performRequest('POST', "/item/{$data['user_type']}/{$data['user_type_id']}/{$data['date']}/{$data['hour']}", $data);
    }

    public function updateItem($data)
    {
        // dd($data);
        return $this->performRequest('PUT', "/item/{$data['shopping_list_id']}", $data);
    }

    public function deleteItem($data)
    {
        $args = implode('/', array_values($data));
        return $this->performRequest('DELETE', "/item/{$args}");
    }
}