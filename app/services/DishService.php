<?php

namespace App\Services;

use App\Traits\ConsumeService;

class DishService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.dishes.base_uri');
    }

    public function obtainDish($slug)
    {
        return $this->performRequest('GET', "/dish/{$slug}");
    }

    public function obtainByCategory($category_name, $tags = '')
    {
        // dd("/category/{$category_name}?tags={$tags}");
        return $this->performRequest('GET', "/category/{$category_name}?tags={$tags}");
    }

    public function obtainByOwner($dish_type, $user_type_id, $tags = '')
    {
        return $this->performRequest('GET', "/{$dish_type}/{$user_type_id}/?tags={$tags}");
    }

    public function obtainByTypeAndId($dish_type, $dish_id)
    {
        return $this->performRequest('GET', "/dishbytype/{$dish_type}/{$dish_id}");
    }

    public function obtainByIDs($ids)
    {
        $ids = implode(',', $ids);
        return $this->performRequest('GET', "/getbyids/?ids={$ids}");
    }

    public function addDish($data, $dish_type)
    {
        return $this->performRequest('POST', "/dish/{$dish_type}", $data);
    }
    public function update($data, $dish_type, $dish_id)
    {
        return $this->performRequest('PATCH', "/dish/{$dish_type}/{$dish_id}", $data);
    }
    public function removeDish($dish_type, $dish_id)
    {
        return $this->performRequest('DELETE', "/dish/{$dish_type}/{$dish_id}");
    }

    /**
     * Categories
     **/
    public function getCategories($user_type, $user_type_id)
    {
        return $this->performRequest('GET', "/{$user_type_id}/category");
    }
    public function addCategory($data, $user_type_id)
    {
        return $this->performRequest('POST', "/{$user_type_id}/category", $data);
    }
    public function removeCategory($data, $user_type_id)
    {
        return $this->performRequest('DELETE', "/{$user_type_id}/category", $data);
    }

    /**
     * Restaurant
     **/
    public function addDishToRestaurantID($data)
    {
        return $this->performRequest('POST', "/adddishtorestaurantid", $data);
    }
    public function removeDishToRestaurantID($data)
    {
        return $this->performRequest('DELETE', "/removedishtorestaurantid", $data);
    }

}