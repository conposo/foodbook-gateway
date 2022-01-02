<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Services\RestaurantService;

class LoginController extends Controller
{
    protected $restaurantService;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {

        $restaurants = [];
        $random_number_array = range(1, 100);
        shuffle($random_number_array );
        $random_number_array = array_slice($random_number_array ,0,30);
        if( $restaurant = $this->restaurantService->obtainByIDs( $random_number_array ) )
        {
            if( json_decode($restaurant) )
            {
                $restaurants = collect( json_decode($restaurant, true)['data'] )->toArray();
            }
        }

        return view('auth.login', ['restaurants' => $restaurants]);
    }
}
