<?php

namespace App\Http\Middleware;

use Closure;

use App\Services\HouseholdService;

class SetHousehold
{
    private $householdService;

    public function __construct( HouseholdService $householdService)
    {
        $this->householdService = $householdService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $GLOBALS['isHousehold'] = false;
        $household = collect([]);

        if($GLOBALS['user_type_id'])
        {
            if( $_user_member_roles = $this->householdService->obtainHouseholdMemberByUserID($GLOBALS['user_type_id']) )
            {
                if( json_decode($_user_member_roles) )
                {
                    $household = collect( json_decode( $_user_member_roles, true )['data'] );
                }
            }

            // dd( collect( json_decode( $_user_member_roles, true )['data'] )->sortBy('updated_at')->last() );

            if($household->isNotEmpty())
            {
                $GLOBALS['isHousehold'] = true;
                // $GLOBALS['user_type'] = 'household';
                $GLOBALS['household_id'] = $household->first()['household_id'];
                $GLOBALS['household'] = $household->sortBy('updated_at')->last();

                $current_user_household = collect( json_decode( $this->householdService->obtainHousehold($GLOBALS['household_id']), true )['data'] );
                $GLOBALS['household_members'] = $current_user_household['members'];
            }
        }

        // dd($GLOBALS['household']);
        return $next($request);
    }
}
