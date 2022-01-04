<?php

namespace App\Services;

use App\Traits\ConsumeService;

class HouseholdService
{
    use ConsumeService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.household.base_uri');
    }

    public function obtainHousehold($household_id)
    {
        return $this->performRequest('GET', "household/{$household_id}");
    }

    public function obtainHouseholdMemberByUserID($user_id)
    {
        return $this->performRequest('GET', "household-members/{$user_id}");
    }

    public function store($data, $user_id)
    {
        return $this->performRequest('POST', "household/{$user_id}", $data);
    }

    public function update($cleaned_request, $household_id)
    {
        return $this->performRequest('PATCH', "household/{$household_id}", $cleaned_request);
    }

    public function storeMember($data, $user_id)
    {
        // parameters name, user_id
        return $this->performRequest('POST', "member/{$user_id}", $data);
    }

    public function removeMember($data)
    {
        // dd($data);
        return $this->performRequest('DELETE', "member", $data);
    }

    public function updateMember($data, $member_id)
    {
        return $this->performRequest('PATCH', "member/{$member_id}", $data);
    }
}