<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Services\RestaurantService;
use App\Services\DishService;

class RestaurantAdminController extends Controller
{
    protected $restaurantService;
    protected $dishService;

    public function __construct(Request $request, DishService $dishService, RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
        $this->dishService = $dishService;

        if( is_numeric($request->slug) ) {
            $this->restaurant = $this->restaurantService->obtainByIDs([$request->slug]);
        } else {
            $this->restaurant = $this->restaurantService->obtainRestaurant($request->slug);
        }

        if( json_decode($this->restaurant, true) )
        {
            if( is_numeric($request->slug) ) {
                $this->restaurant = json_decode($this->restaurant, true)['data'][0];
            } else {
                $this->restaurant = json_decode($this->restaurant, true)['data'];
            }
            $this->restaurant_id = $this->restaurant['id'];
        }

        if( $this->restaurant && $request->slug && $request->isMethod('get') )
        {
            $this->middleware(function (Request $request, $next) {
                foreach($this->restaurant['categories'] as $restaurant_category)
                {
                    $GLOBALS['categories'][$restaurant_category['category']] = $restaurant_category;
                }
                $GLOBALS['all_categories'] = $GLOBALS['categories'];

                return $next($request);
            });
        }
        // else { return abort(404); }
    }

    public function ownedRestaurants()
    {
        ini_set('memory_limit', '-1');
        $user = Auth::user();
        $this->user_id = $user->id;

        $roles = $this->restaurantService->obtainUserRoles($this->user_id);
        if( !empty($roles) && isset( json_decode($roles, true)['data'] ) )
        {
            $roles = json_decode($roles, true)['data'];
        }
        $restaurant_ids = array_map(function ($e) {
            if($e['type'] == 'OWNER') return $e['restaurant_id'];
        }, $roles);
        $restaurant_ids = array_slice($restaurant_ids, 0, 1800);
        // dd($restaurant_ids);
        $restaurants_data = [];
        $restaurant = $this->restaurantService->obtainByIDs($restaurant_ids);
        // dd($restaurant);
        if( json_decode($restaurant, true) && isset(json_decode($restaurant, true)['data']) )
        {
            $restaurants_data = collect( json_decode($restaurant, true)['data'] )->toArray(); // dd($roles, $restaurants_data);
        }

        $data = [
            'user_data' => $user,
            'restaurants_data' => $restaurants_data,
        ];

        // dd($restaurants_data);
        return view('user.restaurants', $data);
    }

    public function settings($slug)
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        
        // To-Do check if user has permissions
        $roles = $this->restaurantService->obtainUserRoles($this->user_id);
        if( !empty($roles) && isset( json_decode($roles, true)['data'] ) )
        {
            $roles = json_decode($roles, true)['data'];  // dd($roles);
            foreach($roles as $role)
            {
                if( $role['user_id'] == $this->user_id && $role['restaurant_id'] = $this->restaurant_id )
                {
                    $data = [
                        // 'user_data' => $user,
                        'restaurant' => $this->restaurant,
                        // 'data' => $data,
                    ];
                    return view('admin.restaurant.settings.index', $data);
                }
                // if($role['type'] == 'OWNER')
                // {
                // }
            }
        }
        return redirect()->route('home');
    }

    public function edit($slug)
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        
        // To-Do check if user has permissions
        
        $restaurant = $this->restaurantService->obtainRestaurant($slug);
        $data = json_decode($restaurant, true)['data'];
        // dd($data);

        // get User IDs from staff model
        $restaurantStaff = $data['staff'];
        $staff_ids = array_map(function ($e) {
            return $e['user_id'];
        }, $restaurantStaff);
        $restaurantStaffUserData = User::find($staff_ids);

        // get pictures
        $restaurant_pictures = [];
        $files = Storage::files('restaurants/'.$slug);
        foreach($files as $file_path)
        {
            $parts = explode('/', $file_path);
            $restaurant_pictures[] = [$parts[1], $parts[2]];
        }

        // dd($restaurantStaff, $restaurantStaffUserData);
        $data = [
            'user' => $user,
            'restaurant' => $data,
            'staff_data' => $restaurantStaff,
            'staff_data_user' => $restaurantStaffUserData,
            'restaurant_pictures' => $restaurant_pictures
        ];
        
        // dd( $GLOBALS['categories'], $data);

        return view('admin.restaurant.edit.index', $data);
    }

    public function update(Request $request, $slug)
    {

        $worktime = [
            "monday" => [
                "from" => [
                    "hours" => $request->monday_from_hour,
                    "minutes" => $request->monday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->monday_to_hour,
                    "minutes" => $request->monday_to_minutes,
                ],
            ],
            "tuesday" => [
                "from" => [
                    "hours" => $request->tuesday_from_hour,
                    "minutes" => $request->tuesday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->tuesday_to_hour,
                    "minutes" => $request->tuesday_to_minutes,
                ],
            ],
            "wednesday" => [
                "from" => [
                    "hours" => $request->wednesday_from_hour,
                    "minutes" => $request->wednesday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->wednesday_to_hour,
                    "minutes" => $request->wednesday_to_minutes,
                ],
            ],
            "thursday" => [
                "from" => [
                    "hours" => $request->thursday_from_hour,
                    "minutes" => $request->thursday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->thursday_to_hour,
                    "minutes" => $request->thursday_to_minutes,
                ],
            ],
            "friday" => [
                "from" => [
                    "hours" => $request->friday_from_hour,
                    "minutes" => $request->friday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->friday_to_hour,
                    "minutes" => $request->friday_to_minutes,
                ],
            ],
            "saturday" => [
                "from" => [
                    "hours" => $request->saturday_from_hour,
                    "minutes" => $request->saturday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->saturday_to_hour,
                    "minutes" => $request->saturday_to_minutes,
                ],
            ],
            "sunday" => [
                "from" => [
                    "hours" => $request->sunday_from_hour,
                    "minutes" => $request->sunday_from_minutes,
                ],
                "to" => [
                    "hours" => $request->sunday_to_hour,
                    "minutes" => $request->sunday_to_minutes,
                ],
            ],
        ];

        // $data = [
        //     'business_name' => $request->business_name,
        //     'worktime' => json_encode($worktime, JSON_UNESCAPED_UNICODE),
        //     'city' => $request->city,
        //     'region' => $request->region,
        //     'postal_code' => $request->postal_code,
        //     'address' => $request->address,
        //     'address_additional' => $request->address_additional,
        //     'coords_x' => $request->coords_x,
        //     'coords_y' => $request->coords_y,
        //     'phone' => $request->phone,
        //     'email' => $request->business_email,
        //     'website' => $request->website,
        //     'fb_page' => $request->fb_page,
        //     'category' => $request->category,
        //     'cuisine' => $request->cuisine,
        //     'price_range' => $request->price_range,
        //     'seats' => $request->seats,
        //     'description' => $request->description,
        // ];

        $request['worktime'] = json_encode($worktime, JSON_UNESCAPED_UNICODE);
        // dd($request->all());
        
        $restaurant_pictures = [];
        Storage::delete($request->delete_pictures);

        $restaurant = $this->restaurantService->updateRestaurant($slug, $request->except('_token', '_method'));
        // dd($restaurant, $request->except('_token', '_method'));

        if ( $restaurant )
        {
            $restaurant_slug = $slug;
            ($request->file('picture_cover') !== null) ? $request->file('picture_cover')->storeAs('restaurants/'.$restaurant_slug, 'cover.jpeg', 'public'): '';
            ($request->file('picture_main') !== null) ? $request->file('picture_main')->storeAs('restaurants/'.$restaurant_slug, 'main.jpeg', 'public'): '';
            ($request->file('picture1') !== null) ? $request->file('picture1')->store('restaurants/'.$restaurant_slug, 'public'): '';
            ($request->file('picture2') !== null) ? $request->file('picture2')->store('restaurants/'.$restaurant_slug, 'public'): '';
            ($request->file('picture3') !== null) ? $request->file('picture3')->store('restaurants/'.$restaurant_slug, 'public'): '';
            ($request->file('picture4') !== null) ? $request->file('picture4')->store('restaurants/'.$restaurant_slug, 'public'): '';
        
            return redirect()->route('restaurant-edit', ['slug' => $slug]);
        }

    }

    public function staff(Request $request, $restaurant_id)
    {

        if($request->remove_staff)
        {
            foreach($request->remove_staff as $staff_data)
            {
                $staff_data = explode(",", $staff_data);
                $data = [
                    'user_id' => $staff_data[0],
                    'type' =>  $staff_data[1],
                    'restaurant_id' => $restaurant_id
                ];
                $removed_staff[] = $this->restaurantService->removeRestaurantStaff($restaurant_id, $data);
            }
            // dd($removed_staff);
        }

        // dd($request, $restaurant_id);
        $user = User::where('email', $request['email'])->get();
        if($user->isNotEmpty())
        {
            $request['user_id'] = $user->first()->id;
            $request['restaurant_id'] = $restaurant_id;
            $data = $request->except('_token', 'email', 'remove_staff');
            $new_staff = $this->restaurantService->addRestaurantStaff($restaurant_id, $data);
            // $data = json_decode($new_staff, true)['data'];
            // dd($new_staff);
            return back()->with('user_staff', 'Записът беше успешен. Потребител <b>'.$user->first()->first_name.'</b> с имейл <b>'.$request['email'].'</b> вече е част от персонала!'); //  на <b>'.$this->restaurant['business_name'].'</b>
        }
        else
        {
            return back()->with('user_staff', 'Потребител с имейл <b>'.$request['email'].'</b> не съществува!');
        }
        // return redirect()->route('restaurant-edit', ['slug' => $slug]);
    }

    public function regions(Request $request, $restaurant_id)
    {
        if($request->isMethod('post'))
        {
            $data = $this->restaurantService->addRegion($request->except('_token', '_method', 'restaurant_slug'), $restaurant_id);
        }
        else if($request->isMethod('delete'))
        {
            // To-Do validate
            $data = $this->restaurantService->removeRegion($request->region_id);
        }
        
        return redirect()->route('restaurant-edit', $request['restaurant_slug']);
    }

    public function categories(Request $request, $restaurant_id)
    {
        if($request->isMethod('post') && $request['category_name'])
        {
            $cyr = [
                'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
                'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
                'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
                'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
            ];
            $lat = [
                'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
                'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
                'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
                'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
            ];
            $data = [
                str_replace($cyr, $lat, $request['category_name']) => $request['category_name']
            ];
            $data = $this->restaurantService->addCategories($data, $restaurant_id);
        }
        else if($request->isMethod('delete') && $request['category'])
        {
            $data = $this->restaurantService->removeCategories($request->except('_token', '_method', 'restaurant_slug'), $restaurant_id);
        }
        
        return redirect()->route('restaurant-edit', $request['restaurant_slug']);
    }

    public function menuMain(Request $request, $slug, $category = '')
    {
        if($request->isMethod('post'))
        {
            // dd($request->except('_token'));
            if( $request->dish_type == 'B' )
            {
                $request->is_public == '1';
            }
            $this->restaurantService->addDishTo($request->except('_token'), $slug, 'menu_main');

            // add restauratnID to dish
            $this->dishService->addDishToRestaurantID([
                'restaurant_id' => $this->restaurant_id,
                'dish_id' => $request->dish_id
            ]);
            return redirect()->route('restaurant-edit', ['slug' => $slug]);
        }
        else if($request->isMethod('patch'))
        {
            $data = $request->except('_token', '_method');
            // dd( $data );
            $responce = $this->restaurantService->updateDishFrom($data, $request->item_id, 'menu_main');
            // dd( $responce );
            return redirect()->back();
        }
        else if($request->isMethod('delete'))
        {
            $this->restaurantService->removeDishFrom($request->except('_token', 'method'), $request->item_id, 'menu_main');
            // remove restauratnID to dishService
            $this->dishService->removeDishToRestaurantID([
                'restaurant_id' => $this->restaurant_id,
                'dish_id' => $request->dish_id
            ]);
            return redirect()->route('restaurant-edit', ['slug' => $slug]);
        }
        else if($request->isMethod('get'))
        {
            $_dishes_B = [];
            $restaurant = $this->restaurantService->obtainRestaurant($slug);
            $restaurant = json_decode($restaurant, true)['data'];
            
            // get dishes type_S
            $data = $this->dishService->obtainByCategory($category);
            $dishes_S = json_decode($data, true);
            // get dishes type_B
            $data = $this->dishService->obtainByOwner('B', $this->restaurant_id);
            $dishes_B = json_decode($data, true);

            $collection = collect( $dishes_B['data'] );
            $_dishes_B = $collection->filter(function($item) use ($category) {
                if( $item['category'] == $category ) return $item;
            })->toArray();

            $data = [];
            $data['data']['S'] = $dishes_S;
            $data['data']['B'] = $_dishes_B;
            $data['restaurant'] = $restaurant;
            $data['category'] = ['slug' => $category];
            return view('admin.restaurant.edit.proposals.menus.category.index', $data);
        }
    }

    public function menuLunch(Request $request, $slug, $category)
    {
        if($request->isMethod('post'))
        {
            $data = $this->dishService->addDishTo($request, $slug, 'menu_lunch');
            return back();
        }
        else if($request->isMethod('delete'))
        {
        }
        else
        {
            // return '';
            // get dishes type_S
            $data = $this->dishService->obtainByCategory($category);
            $data = json_decode($data, true);
            $data['restaurant'] = ['slug' => $slug];
            $data['category'] = ['slug' => $category];
            // dd($data);
            // get dishes type_B
            return view('admin.restaurant.edit.proposals.menus.lunch.index', $data);  
        }
    }

    public function newRestaurant(Request $request)
    {
        
        if($request->isMethod('post'))
        {
            // dd( $request->except('_token', '_method') );
            $_request = array_filter( $request->except('_token', '_method') );
            // make request
            $responce = $this->restaurantService->addRestaurant($_request);
            // dd( $responce );
            return redirect()->route('restaurants');
        }

        return view('admin.restaurant.new.index');  
    }
}
