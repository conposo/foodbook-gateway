<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DishService;

class HomeController extends Controller
{
    public $dishService;
    protected $date;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(DishService $dishService)
    {
        $this->dishService = $dishService;
        $this->date = $GLOBALS['date'];
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function menu()
    {
        $dishes = [];
        foreach($GLOBALS['categories'] as $category)
        {
            $dishes[$category['slug']] = json_decode($this->dishService->obtainByCategory($category['slug'], ''), true);
        }
        // dd( $dishes );
        // dd( $this->data );
        return view('home.index', ['date' => $this->date, 'dishes' => $dishes]);
    }
}
