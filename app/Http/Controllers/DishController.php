<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Services\RestaurantService;
use App\Services\DishService;

class DishController extends Controller
{
    protected $dishService;
    protected $restaurantService;
    
    public function __construct(Request $request, DishService $dishService, RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
        $this->dishService = $dishService;
        
        if($request->slug)
        {
            $this->restaurant = $this->restaurantService->obtainRestaurant($request->slug);
            $this->restaurant = json_decode($this->restaurant, true)['data'];
            $this->restaurant_id = $this->restaurant['id'];

            $this->middleware(function (Request $request, $next) {
                foreach($this->restaurant['categories'] as $restaurant_category)
                {
                    $GLOBALS['categories'][$restaurant_category['category']] = $restaurant_category;
                }
                $GLOBALS['all_categories'] = $GLOBALS['categories'];
                return $next($request);
            });
        }
    }


    public function index($slug, $category)
    {
        // get dishes type_B
        $data = $this->dishService->obtainByOwner('B', $this->restaurant_id);
        $data = json_decode($data, true);

        $data['restaurant'] = $this->restaurant;
        $data['category'] = ['slug' => $category];

        return view('admin.restaurant.edit.proposals.dishes.category.index', $data);  
    }


    public function store(Request $request, $slug)
    {
        if( in_array(null, $request->all(), true) ) return back();
        $restaurant_slug = $request->slug;

        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' '
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya', '-'
        ];
        
        if($request->dish_type == 'B')
        {
            // get Restaurant
            // $this->restaurant_id = 1;
        }

        $request['owner_id'] = $this->restaurant_id;
        $request['slug'] = mb_strtolower( str_replace($cyr, $lat, $request['bg_name']) ).$request['owner_id'];
        $data = $this->dishService->addDish($request->except('_token'), $request->dish_type);
        return back()->with('status', 'created');
    }

    public function destroy(Request $request, $dish_type, $dish_id)
    {
        // check if User is dish owner
        $owner_id = $request->owner_id;
        $category = $request->category;
        $checked_dish = $this->dishService->obtainByOwner($dish_type, $owner_id, $category, $tags = '');
        // dd( $dish_type, $dish_id, $owner_id, collect(json_decode($checked_dish, true)['data'])->where('id', $dish_id)->isNotEmpty() );
        if( collect(json_decode($checked_dish, true)['data'])->where('id', $dish_id)->isNotEmpty() )
        {
            $data = $this->dishService->removeDish($dish_type, $dish_id);
            return back()->with('status', 'deleted');
        }
        else
        {
            return back();
        }
    }

}
