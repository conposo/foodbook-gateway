<?php

namespace App\Http\Middleware;

use Closure;

use App\Services\ListService;

class SetLists
{
    protected $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
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
        $GLOBALS['is_list'] = false;
        
        if($GLOBALS['user_type_id']):
            $this->date = $GLOBALS['date'];
            $this->time = explode(':', $GLOBALS['meal_time']);
            $this->hour = array_shift($this->time);

            $this->user_type = 'user';
            $this->user_type_id = $GLOBALS['user_type_id'];
            // get list
            if( $data = $this->listService->obtainList($this->user_type, $this->user_type_id, $this->date, $this->hour) )
            {
                if( json_decode($data, true) ) $data = json_decode($data, true)['data'];
                if($data && !empty($data['items']))
                {
                    $GLOBALS['list_data'] = $data;
                    $GLOBALS['is_list'] = true;
                }
            }

            if($GLOBALS['isHousehold'])
            {
                $this->user_type = 'household';
                $this->user_type_id = $GLOBALS['household_id'];
                // get list
                if( $data = $this->listService->obtainList($this->user_type, $this->user_type_id, $this->date, $this->hour) )
                {
                    if( json_decode($data, true) ) $data = json_decode($data, true)['data'];
                    if($data && !empty($data['items']))
                    {
                        $GLOBALS['household_list_data'] = $data;
                        $GLOBALS['is_list'] = true;
                    }
                }
            }

            
        endif;
        // dd($data, empty($data['items']), $GLOBALS['is_list']);

        return $next($request);
    }
}
