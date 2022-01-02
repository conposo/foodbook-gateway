<?php

namespace App\Http\Middleware;

use Closure;

use App\Services\DishService;

class SetCategories
{
    protected $dishService;

    public function __construct(DishService $dishService)
    {
        $this->dishService = $dishService;
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
        $categories = [
            [
                'soups',
                'soups',
                'супи'
            ],
            [
                'salads',
                'salads',
                'салати'
            ],
            [
                'starters',
                'starters',
                'предястия'
            ],
            [
                'garnish',
                'garnish',
                'гарнитури'
            ],
            [
                'maindishes',
                'maindishes',
                'основни'
            ],
            [
                'pizza',
                'pizza',
                'пица'
            ],
            [
                'pasta',
                'pasta',
                'паста'
            ],
            [
                'bread',
                'bread',
                'хляб'
            ],
            [
                'desserts',
                'desserts',
                'десерти'
            ],
        ];


        $all_categories = [
            [
                'soups',
                'soups',
                'супи',
            ],
            [
                'salads',
                'salads',
                'салати',
            ],
            [
                'starters',
                'starters',
                'предястия',
            ],
            [
                'hot-starters',
                'hot-starters',
                'Топли предястия',
            ],
            [
                'cold-starters',
                'cold-starters',
                'Студени предястия',
            ],
            [
                'garnish',
                'garnish',
                'гарнитури',
            ],
            [
                'maindishes',
                'maindishes',
                'основни',
            ],
            [
                'pizza',
                'pizza',
                'пица',
            ],
            [
                'pasta',
                'pasta',
                'паста',
            ],
            [
                'antipasto',
                'antipasto',
                'Антипасто',
            ],
            [
                'fresh_pasta_risotto',
                'fresh_pasta_risotto',
                'Прясна паста и ризото',
            ],
            [
                'bread',
                'bread',
                'хляб',
            ],
            [
                'zapekanki',
                'zapekanki',
                'Запеканки',
            ],
            [
                'desserts',
                'desserts',
                'десерти',
            ],
            [
                'cakes',
                'cakes',
                'Торти',
            ],
            [
                'sandwiches',
                'sandwiches',
                'сандвичи',
            ],
            [
                'icecream',
                'icecream',
                'сладолед',
            ],
            [
                'burgers',
                'burgers',
                'бургери',
            ],
            [
                'barbecue',
                'barbecue',
                'барбекю',
            ],
            [
                'others',
                'others',
                'други',
            ],
            [
                'drinks',
                'drinks',
                'напитки',
            ],
            [
                'coca-cola',
                'coca-cola',
                'coca-cola',
            ],
            [
                'sauces',
                'sauces',
                'сосове',
            ],
            [
                'fish',
                'fish',
                'риба',
            ],
            [
                'beer',
                'beer',
                'бира',
            ],
            [
                'craft-beer',
                'craft-beer',
                'Крафт Бири',
            ],
            [
                'meatless',
                'meatless',
                'безмесни',
            ],
            [
                'meat',
                'meat',
                'месни',
            ],
            [
                'poultry',
                'poultry',
                'птиче месо',
            ],
            [
                'risotto',
                'risotto',
                'ризото',
            ],
            [
                'grill',
                'grill',
                'скара',
            ],
            [
                'wine',
                'wine',
                'вино',
            ],
            [
                'sparkling-wine',
                'sparkling-wine',
                'пенливи вина',
            ],
            [
                'white-wine',
                'white-wine',
                'бели вина',
            ],
            [
                'rose',
                'rose',
                'розе',
            ],
            [
                'red-wine',
                'red-wine',
                'червени вина',
            ],
            [
                'dessert-wine',
                'dessert-wine',
                'десертно вино',
            ],
            [
                'lemonade',
                'lemonade',
                'лимонада',
            ],
            [
                'fresh',
                'fresh',
                'фрешове',
            ],
            [
                'smoothie',
                'smoothie',
                'Смути',
            ],
            [
                'tortilla',
                'tortilla',
                'Тортиля',
            ],
            [
                'chicken',
                'chicken',
                'пиле',
            ],
            [
                'chicken',
                'chicken',
                'пилешко месо',
            ],
            [
                'pork',
                'pork',
                'свинско',
            ],
            [
                'veal',
                'veal',
                'телешко',
            ],
            [
                'lamb',
                'lamb',
                'агнешко',
            ],
            [
                'beef',
                'beef',
                'Говеждо месо',
            ],
            [
                'veal',
                'veal',
                'Телешко месо',
            ],
            [
                'lamb',
                'lamb',
                'Агнешко месо',
            ],
            [
                'sea',
                'sea',
                'Морски деликатеси',
            ],
            [
                'fish-sea',
                'fish-sea',
                'риба и морски дарове',
            ],
            [
                'sushi',
                'sushi',
                'суши',
            ],
            [
                'additives',
                'additives',
                'добавки',
            ],
            [
                'duck',
                'duck',
                'патица',
            ],
            [
                'rice',
                'rice',
                'ориз',
            ],
            [
                'specialties',
                'specialties',
                'специалитети',
            ],
            [
                'sachs',
                'sachs',
                'сачове',
            ],
            [
                'pan',
                'pan',
                'ястия на тиган',
            ],
            [
                'appetizer',
                'appetizer',
                'разядки',
            ],
            [
                'dry-appetizer',
                'dry-appetizer',
                'мезета',
            ],
            [
                'lasagne',
                'lasagne',
                'лазаня',
            ],
            [
                'alaminuti',
                'alaminuti',
                'аламинути',
            ],
            [
                'hot-dog',
                'hot-dog',
                'Хот Дог',
            ],
            [
                'burrito',
                'burrito',
                'Бурито',
            ],
            [
                'quesadilla',
                'quesadilla',
                'Кесадия',
            ],
            [
                'sashimi',
                'sashimi',
                'Сашими',
            ],
            [
                'dunners',
                'dunners',
                'дюнери',
            ],
            [
                'dunner',
                'dunner',
                'дюнер',
            ],
            [
                'katmi',
                'katmi',
                'катми',
            ],
            [
                'sweet_katmi',
                'sweet_katmi',
                'сладки Катми',
            ],
            [
                'salted_katmi',
                'salted_katmi',
                'солени Катми',
            ],
            [
                'antipasto',
                'antipasto',
                'антипасто',
            ],
            [
                'fruits',
                'fruits',
                'плодове',
            ],
            [
                'lunch',
                'lunch',
                'обедно меню',
            ],
            [
                'vegetarian',
                'vegetarian',
                'вегетарианско меню',
            ],
            [
                'thursday',
                'thursday',
                'четвъртък',
            ],
            [
                'friday',
                'friday',
                'петък',
            ],
            [
                'breakfast',
                'breakfast',
                'закуска',
            ],
            [
                'brunch',
                'brunch',
                'брънч',
            ],
        ];

        $this->user_type_id = $GLOBALS['user_type_id'];

        $GLOBALS['categories'] = [];
        $GLOBALS['_all_categories'] = [];
        foreach($categories as $category)
        {
            $GLOBALS['categories'][$category['0']] = [ 'slug' => $category['0'],  'en_name' => $category['1'], 'bg_name' => $category['2'] ];
        }
        foreach($all_categories as $category)
        {
            $GLOBALS['_all_categories'][$category['0']] = [ 'slug' => $category['0'],  'en_name' => $category['1'], 'bg_name' => $category['2'] ];
        }        

        if($GLOBALS['isHousehold'])
        {
            // get Household members IDs
            $household_members_IDs = collect($GLOBALS['household_members'])->pluck('user_id')->toArray();
            // get Household members categories
            foreach($household_members_IDs as $member_id)
            {
                if($categories = $this->dishService->getCategories('P', $member_id))
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
            }
        }
        else if($this->user_type_id)
        {
            if($categories = $this->dishService->getCategories('P', $this->user_type_id))
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
        }

        // dd( $GLOBALS['categories'] );
        return $next($request);
    }
}
