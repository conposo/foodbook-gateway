<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Services\DishService;
use App\Services\IngredientsService;

class DishUserController extends Controller
{
    protected $dishService;
    protected $ingredientsService;
    
    public function __construct(Request $request, DishService $dishService, IngredientsService $ingredientsService)
    {
        $this->dishService = $dishService;
        $this->ingredientsService = $ingredientsService;

        $this->date = $GLOBALS['date'];
        $this->time = $GLOBALS['meal_time'];

        $this->user_type = 'user';

        $this->middleware(function (Request $request, $next) {
            $this->user_type_id = \Auth::id(); //$GLOBALS['user_type_id'];
            return $next($request);
        });
        // foreach($this->restaurant['categories'] as $restaurant_category)
        // {
        //     $GLOBALS['categories'][$restaurant_category['category']] = $restaurant_category;
        // }
        // // dd($GLOBALS['categories'], $this->restaurant['categories']);
        // $GLOBALS['all_categories'] = $GLOBALS['categories'];
    }

    public function index($category = '')
    {
        // get dishes type_P
        $data = [];
        if( $data = $this->dishService->obtainByOwner('P', $this->user_type_id, $category) )
        {
            $data = json_decode($data, true);
        }

        if( $categories = $this->dishService->getCategories('P', $this->user_type_id) )
        {
            $categories = json_decode($categories, true);
            if(isset($categories['data']))
                $categories = $categories['data'];
        }

        if(isset($categories)):
            foreach($categories as $category):
                $GLOBALS['categories'][$category['slug']] = [
                    'slug' => $category['slug'],
                    'en_name' => $category['en_name'],
                    'bg_name' => $category['bg_name'],
                    'custom' => true,
                ];
            endforeach;
        endif;
        // if(empty($data)) $data['data'] = []; else $data['data'] = $data;
        // dd($data);
        
        // get ingredients
        $data['ingredients'] = [];
        $ingredients = $this->ingredientsService->all();
        if( $ingredients = json_decode($ingredients, true) )
        {
            $data['ingredients'] = $ingredients['data'];
        }

        return view('user.dishes.index', ['data' => $data]);
        // return view('static.dish.single.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request->except('ingredients'));
        // dd($request->all(), $request->file('picture_main'));

        if( in_array(null, $request->except('ingredients', 'steps'), true) ) return back()->with('status', 'empty_value');

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

        $request['owner_id'] = $this->user_type_id;
        $slug = $request['slug'] = mb_strtolower( str_replace($cyr, $lat, $request['bg_name']) ).'-'.$request['owner_id'].rand(0,9999);
        $data = $this->dishService->addDish($request->except('_token'), 'P');

        if($request->file('picture_main')) $request->file('picture_main')->storeAs('dishes/'.$slug, 'main.jpeg');
        if($request->file('pictures')):
            $count = 1;
            foreach($request->file('pictures') as $new_picture)
            {
                $name = explode('.', $new_picture->getClientOriginalName())[0];
                $new_picture->storeAs('dishes/'.$slug, "{$name}.jpeg");
                $count++;
            }
        endif;
        return back()->with('status', 'created');
    }

    public function destroy(Request $request, $dish_type, $dish_id)
    {
        // check if User is dish owner
        $category = $request->category;
        $checked_dish = $this->dishService->obtainByOwner($dish_type, $this->user_type_id, $tags = '');
        // dd( $dish_type, $dish_id, $this->user_type_id, collect(json_decode($checked_dish, true)['data'])->where('id', $dish_id)->isNotEmpty() );
        if( collect(json_decode($checked_dish, true)['data'])->where('id', $dish_id)->isNotEmpty() )
        {
            $data = $this->dishService->removeDish($dish_type, $dish_id);
            return redirect()->route('recipes')->with('status', 'deleted');
        }
        else
        {
            return back();
        }
    }

    public function category(Request $request)
    {
        if($request->isMethod('post') && $request['slug'])
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
                'slug' => str_replace($cyr, $lat, str_replace(' ', '-', $request['slug'])),
                'en_name' => str_replace($cyr, $lat, $request['slug']),
                'bg_name' => $request['slug']
            ];
            // dd($data, $this->user_type_id);
            $data = $this->dishService->addCategory($data, $this->user_type_id);
        }
        else if($request->isMethod('delete') && $request['slug'])
        {
            $data = $this->dishService->removeCategory($request->except('_token', '_method'), $this->user_type_id);
        }
        
        return back()->with('status', 'created');
    }

    public function edit($dish_type, $dish_slug)
    {
        // $user_dishes = $this->dishService->obtainByOwner($dish_type, $this->user_type_id);
        $dish = $this->dishService->obtainByTypeAndId($dish_type, $dish_slug);
        $dish = collect( json_decode($dish, true)['data'] );
        // dd($dish);        
        // get ingredients
        $dish_pictures = [];
        $files = Storage::files('dishes/'.$dish['slug']);
        foreach($files as $file_path)
        {
            $parts = explode('/', $file_path);
            $dish_pictures[] = [$parts[1], $parts[2]];
        }
        $data['dish_pictures'] = $dish_pictures;
        $ingredients = $this->ingredientsService->all();
        $ingredients = json_decode($ingredients, true);
        
        $data['ingredients'] = $ingredients['data'];
        // dd($dish_type, $data, $dish, $ingredients, $dish_pictures);
        return view('user.dishes.edit', ['data' => $data, 'dish' => $dish, 'dish_pictures' => $dish_pictures, 'dish_type' => $dish_type]);
    }

    public function update(Request $request, $dish_type, $dish_id)
    {
        // dd($request->except('_token', '_method', 'recipe_id'));

        if( $dish_type == 'B' && $request->public )
        {
            // add to model Specialties
        }
        
        // To-Do -> check if User is dish owner

        if( empty(json_decode($request->steps)) ) $request['steps'] = null;

        // dd( $dish_type, json_decode($request->steps) );

        $data = $request->except('_token', '_method');
        // $checked_dish = $this->dishService->obtainByOwner($dish_type, $this->user_type_id, $tags = '');
        $edited_dish = $this->dishService->obtainByTypeAndId($dish_type, $dish_id);
        if( json_decode($edited_dish, true) && isset(json_decode($edited_dish, true)['data']) )
        {
            $edited_dish = json_decode($edited_dish, true)['data'];

            if( in_array($dish_id, $edited_dish) )
            {
                $responce = $this->dishService->update($data, $dish_type, $dish_id);
                // dd($data, $responce);
    
                Storage::delete($request->delete_pictures);

                $slug = $edited_dish['slug'];
                if( !$slug )
                {
                    $responce = json_decode($responce);
                    $slug = $responce->data->slug;
                }
                // dd($slug, $request->file('picture_main'), $request->file('pictures'));
                if($request->file('picture_main')):
                    $request->file('picture_main')->storeAs('dishes/'.$slug, 'main.jpeg');
                endif;
                $count = 1;
                if($request->file('pictures')):
                    foreach($request->file('pictures') as $new_picture)
                    {
                        $name = explode('.', $new_picture->getClientOriginalName())[0];
                        $new_picture->storeAs('dishes/'.$slug, "{$name}.jpeg");
                        $count++;
                    }
                endif;
            }
        }
        
        // dd($dish_type, $this->user_type_id, $edited_dish);
        
        return back();
    }
}
