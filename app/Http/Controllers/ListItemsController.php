<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Services\ListService;

class ListItemsController extends Controller
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
            if($request->user_type_id)
            {
                $this->user_type_id = $request->user_type_id;
            }

            $this->user_type = $GLOBALS['user_type'];
            if($request->user_type)
            {
                $this->user_type = $request->user_type;
            }

            return $next($request);
        });
    }

    public function addItem(Request $request)
    {
        $request['date'] = $this->date;
        $request['hour'] = $this->hour;
        $request['user_type'] = $this->user_type;
        $request['user_type_id'] = $this->user_type_id;
        // dd( $request->except('_token') );
        $data = $this->listService->postItem($request->except('_token'));
        // dd($data);
        return back();
    }

    public function updateItem(Request $request)
    {
        $data = $this->listService->updateItem($request->except(['_token', '_method']));
        return back();
    }

    public function deleteItem(Request $request)
    {
        $data = $this->listService->deleteItem($request->except(['_token', '_method']));
        return back();
    }
}
