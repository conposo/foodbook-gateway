<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;

use App\Services\ListService;

class ListController extends Controller
{
    protected $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
        
        $this->date = $GLOBALS['date'];
        $this->time = explode(':', $GLOBALS['meal_time']);
        $this->hour = array_shift($this->time);

        $this->middleware(function (Request $request, $next) {
            $this->user_type_id = $GLOBALS['user_type_id']; // current_user_id

            $this->user_type = $GLOBALS['user_type'];
            if($request->user_type)
            {
                $this->user_type = $request->user_type;
            }

            return $next($request);
        });
    }

    public function index()
    {
        $data['data'] = [];
        $personal_items = [];
        $household_items = [];

        foreach([05, 11, 17] as $meal_hour)
        {
            if( $_data = $this->listService->obtainList('user', $this->user_type_id, $this->date, $meal_hour) )
            {
                if(json_decode($_data, true))
                {
                    // var_dump(json_decode($_data, true)['data']['items']);
                    if( json_decode($_data, true)['data'] )
                    {
                        $personal_items[] = json_decode($_data, true)['data']['items'];
                    }
                }
            }
            if( $GLOBALS['isHousehold'] )
            {
                if( $_data = $this->listService->obtainList('household', $GLOBALS['household_id'], $this->date, $meal_hour) )
                {
                    if(json_decode($_data, true)['data'])
                    {
                        $household_items[] = json_decode($_data, true)['data']['items'];
                    }
                }
            }
        }
        if( !empty($personal_items) )
        {
            // dd($personal_items, array_merge(...$personal_items));
            $data['data']['personal_items'] = array_merge(...$personal_items);
        }
        if( !empty($household_items) )
        {
            // dd($household_items, array_merge(...$household_items));
            $data['data']['household_items'] = array_merge(...$household_items);
        }

        // if($data['data']['status'] == 'active')
        // {
        //     $items = $this->listService->getItems($data['data']['id']);
        //     $items = json_decode($items, true);
        //     $data['data']['items'] = $items['data'];
        // }
        // dd($data);
        return view('list.daily.index', $data);
    }

    public function weekly()
    {
        $start_week = $GLOBALS['week_start'];
        $end_week = $GLOBALS['week_end'];

        if( $data = $this->listService->obtainWeeklyList($this->user_type, $this->user_type_id, $start_week, $end_week) )
        {
            if( json_decode($data, true) )
            {
                if($data = json_decode($data, true)['data'])
                {
                    foreach($data as $list)
                    {
                        $personal_items[] = $list['items'];
                    }
                    if(isset($personal_items))
                    {
                        // dd($personal_items, array_merge(...$personal_items));
                        $data['data']['personal_items'] = array_merge(...$personal_items);
                    }
                }
            }
        }

        if( $GLOBALS['isHousehold'] )
        {
            if( $household_data = $this->listService->obtainWeeklyList('household', $GLOBALS['household_id'], $start_week, $end_week) )
            {
                if( json_decode($household_data, true) )
                {
                    if( $household_data = json_decode($household_data, true)['data'] )
                    {
                        foreach($household_data as $list)
                        {
                            $household_items[] = $list['items'];
                        }
                        if(isset($personal_items))
                        {
                            $data['data']['household_items'] = array_merge(...$household_items);                    
                        }
                    }
                }
            }
        }

        if( is_string($data) ) $data = json_decode($data);
        return view('list.weekly.index', $data);
    }

    public function monthly()
    {
        $start_month = $GLOBALS['month_start'];
        $end_month = $GLOBALS['month_end'];

        $data = $this->listService->obtainMonthlyList($this->user_type, $this->user_type_id, $start_month, $end_month);
        
        if( json_decode($data, true) )
        {
            if( $data = json_decode($data, true)['data'] )
            {
                foreach($data as $list)
                {
                    $personal_items[] = $list['items'];
                }
                if(isset($personal_items))
                {
                    // dd($personal_items, array_merge(...$personal_items));
                    $data['data']['personal_items'] = array_merge(...$personal_items);
                }
            }
        }


        if($GLOBALS['isHousehold'])
        {
            $household_data = $this->listService->obtainMonthlyList('household', $GLOBALS['household_id'], $start_month, $end_month);
            if( json_decode($household_data, true) )
            {
                if( $household_data = json_decode($household_data, true)['data'] )
                {
                    foreach($household_data as $list)
                    {
                        $household_items[] = $list['items'];
                    }
                    if(isset($personal_items))
                    {
                        $data['data']['household_items'] = array_merge(...$household_items);                    
                    }
                }
            }
        }
        // dd($data);
        if( is_string($data) ) $data = json_decode($data);
        return view('list.monthly.index', $data);
    }

    public function update(Request $request)
    {
        $data = $this->listService->updateList($request->except(['_token', '_method']));
        return back();
    }

}
