<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

use App\Services\HouseholdService;

class HouseholdController extends Controller
{
    private $householdService;
    private $user_id;
    private $household;
    private $other_households;
    private $other_household_members;

    public function __construct(Request $request, HouseholdService $householdService)
    {
        $this->householdService = $householdService;

        $this->data['current_user_guest'] = collect([]);
        $this->data['household'] = collect([]);
        
        $this->middleware(function (Request $request, $next) {
            $this->user_id = \Auth::id();
            return $next($request);
        });
    }

    public function index()
    {
        $this->data['current_user'] = User::where('id', $this->user_id)->first();
        $_user_member_roles = $this->householdService->obtainHouseholdMemberByUserID($this->user_id);
        $this->current_user_member_roles = collect( json_decode( $_user_member_roles, true )['data'] );
        // dd( collect( json_decode( $_user_member_roles, true )['data'] )->sortBy('updated_at')->last() );

        if(!is_null($this->current_user_member_roles))
        {
            $_current_user_household_id = $this->current_user_member_roles->where('user_type', 'ORGANIZER')->first()['household_id'];
            if(is_null($_current_user_household_id))
            {
                $_current_user_household_id = $this->current_user_member_roles->first()['household_id'];
            }
            if(!is_null($_current_user_household_id))
            {
                $current_user_household = collect( json_decode( $this->householdService->obtainHousehold($_current_user_household_id), true )['data'] );
                $this->data['household'] = $current_user_household;
            }
            $current_user_guest = $this->current_user_member_roles->where('user_type', 'GUEST');
            $this->data['current_user_guest'] = $current_user_guest;
        }

        // dd( $this->data['household']['members'] );
        return view('household.index', $this->data);
    }

    public function store(Request $request)
    {
        // dd($request->except('_token', 'email'), $this->user_id);
        $this->householdService->store($request->except('_token', 'email'), $this->user_id);
        return redirect()->route('household');
    }

    public function update(Request $request, $household_id)
    {
        // dd($request, $household_id);
        $this->householdService->update($request->except('_token', '_method'), $household_id);
        return redirect()->route('household');
    }

    public function storeMember(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user)
        {
            // $request['user_id'] = $user->id;
            $request['status'] = 'PENDING';
            // dd($request->except('_token', 'email'), $user->id);
            $this->householdService->storeMember($request->except('_token', 'email'), $user->id);
            return redirect()->route('household')->with('store-member', 'Потребителят е записан успешно!');
        }
        else
        {
            return redirect()->route('household')->with('store-member', 'Няма такъв потребител!');
        }

        return redirect()->route('household')->with('store-member', '');
    }

    public function removeMember(Request $request)
    {
        $requested_id = $request->id;

        // check if member is current_user
        $_user_member_roles = $this->householdService->obtainHouseholdMemberByUserID($this->user_id);
        $this->current_user_member_roles = collect( json_decode( $_user_member_roles, true )['data'] );
        $this->current_user_member_roles = $this->current_user_member_roles->where('user_id', '=', $this->user_id);
        if($this->current_user_member_roles->where('id', '=', $requested_id)->isNotEmpty())
        {
            $this->householdService->removeMember($request->except('_token', '_method'));
            // dd($this->householdService->removeMember($request->except('_token', '_method')));
        }
        else
        {
            $_current_user_household_id = $this->current_user_member_roles->where('user_type', 'ORGANIZER')->first()['household_id'];
            $current_user_household = json_decode( $this->householdService->obtainHousehold($_current_user_household_id), true )['data'];
            if( collect($current_user_household['members'])->where('id', '=', $requested_id)->isNotEmpty() )
            {
                $this->householdService->removeMember($request->except('_token', '_method'));
            }
        }
        return back();
    }

    public function updateMember(Request $request, $member_id)
    {
        // dd($request->except('_token', '_method'));
        $this->householdService->updateMember($request->except('_token', '_method'), $member_id);
        return back();
    }
}
