<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\RestaurantService;

use App\UserPositions;

class SettingsController extends Controller
{
    protected $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    public function index()
    {
        $user = Auth::user()->load('positions');
        $this->user_id = $user->id;

        if( $roles = $this->restaurantService->obtainUserRoles($this->user_id) )
        {
            if( json_decode($roles, true) )
            {
                $roles = json_decode($roles, true)['data'];
            } else $roles = [];
            $restaurant_ids = array_map(function ($e) {
                return $e['restaurant_id'];
            }, $roles);
        }
            
        $restaurants_data = [];
        if( $restaurant = $this->restaurantService->obtainByIDs($restaurant_ids) )
        {
            if( json_decode($restaurant, true) ) $restaurants_data = collect( json_decode($restaurant, true)['data'] )->toArray();
        } else $restaurants_data = collect($restaurants_data);
        // dd($roles, $restaurants_data);

        $data = [
            'user_data' => $user,
            'roles' => $roles,
            'restaurants_data' => $restaurants_data,
        ];

        return view('user.settings', $data);
    }

    public function save_position(Request $request)
    {
        $user = Auth::user();        
        $positions = UserPositions::where('user_id', '=', $user->id);
        // dd($positions);
        if($request->foodbook_chef)
        {
            $positions = $positions->get()->pluck('position')->toArray();
            if( !in_array('foodbook_chef', $positions) )
                $new_position = UserPositions::create(['user_id' => $user->id, 'position' => 'foodbook_chef']);
        }
        elseif($request->position)
        {
            // dd($positions);
            $positions->where('position', '<>', 'foodbook_chef')->delete();
            $positions = $positions->get()->pluck('position')->toArray();
            foreach($request->position as $position)
            {
                if( true || !in_array($position, $positions) )
                {
                    $new_position = UserPositions::create(['user_id' => $user->id, 'position' => $position]);
                }
            }
        }
        else
        {
            if(isset($positions)) $positions->delete();
        }
        return redirect()->route('settings');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = [];

        // dd($request->email != $user->email);
        if($request->email != $user->email)
        {
            $user->sendEmailVerificationNotification();
            $data['email_verified_at'] = null;
        }

        $name = explode(' ', $request->name);
        $data['first_name'] = $name[0];
        $data['last_name'] = (isset($name[1])) ? $name[1] : '';
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        // dd($request->delete_pictures);
        // Storage::delete($request->delete_pictures);
        // dd($data);
        if( $user->update($data) )
        {
            return redirect()->route('settings');
            dd(5, $user->id);
        }
        return redirect()->route('settings');
    }
}
