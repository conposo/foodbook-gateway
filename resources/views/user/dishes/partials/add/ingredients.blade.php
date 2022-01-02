<?php
$ingredients_collection = collect($data['ingredients']);
$ingredients_groups = array_values(array_unique($ingredients_collection->pluck('group')->toArray()));

// dd( $ingredients_groups );

$groups_data = [
    'dried_fruits' => [
        'slug' => 'dried_fruits',
        'en_name' => 'dried_fruits',
        'bg_name' => 'сушени плодове',
    ],
    'fruits' => [
        'slug' => 'fruits',
        'en_name' => 'fruits',
        'bg_name' => 'плодове',
    ],
    'vegetables' => [
        'slug' => 'vegetables',
        'en_name' => 'vegetables',
        'bg_name' => 'зеленчуци',
    ],
    'grains' => [
        'slug' => 'grains',
        'en_name' => 'grains',
        'bg_name' => 'зърнени',
    ],
    'grain-wheat-legumes' => [
        'slug' => 'grain-wheat-legumes',
        'en_name' => 'grain-wheat-legumes',
        'bg_name' => 'зърнено житни',
    ],
    'bee-products' => [
        'slug' => 'bee-products',
        'en_name' => 'bee-products',
        'bg_name' => 'пчелни продукти',
    ],
    'nuts' => [
        'slug' => 'nuts',
        'en_name' => 'nuts',
        'bg_name' => 'ядки',
    ],
    'seeds' => [
        'slug' => 'seeds',
        'en_name' => 'seeds',
        'bg_name' => 'семена',
    ],
    'spices' => [
        'slug' => 'spices',
        'en_name' => 'spices',
        'bg_name' => 'подправки',
    ],
    'herbs' => [
        'slug' => 'herbs',
        'en_name' => 'herbs',
        'bg_name' => 'билки',
    ],
    'eggs' => [
        'slug' => 'eggs',
        'en_name' => 'eggs',
        'bg_name' => 'яйца',
    ],
    'milk' => [
        'slug' => 'milk',
        'en_name' => 'milk',
        'bg_name' => 'мляко',
    ],
    'cheese' => [
        'slug' => 'cheese',
        'en_name' => 'cheese',
        'bg_name' => 'сирена',
    ],
    'fish' => [
        'slug' => 'fish',
        'en_name' => 'fish',
        'bg_name' => 'риба',
    ],
    'meat' => [
        'slug' => 'meat',
        'en_name' => 'meat',
        'bg_name' => 'месо',
    ],
    'mushrooms' => [
        'slug' => 'mushrooms',
        'en_name' => 'mushrooms',
        'bg_name' => 'гъби',
    ],
    'drinks' => [
        'slug' => 'drinks',
        'en_name' => 'drinks',
        'bg_name' => 'напитки',
    ],
    'food-fats' => [
        'slug' => 'food-fats',
        'en_name' => 'food-fats',
        'bg_name' => 'хранителни мазнини',
    ],
    'others' => [
        'slug' => 'others',
        'en_name' => 'others',
        'bg_name' => 'други',
    ],
];
?>
<div class="mb-4 pt-3 accordion" id="accordionWrapper">
        <div class="" id="headingOne" onclick='$("#headingOne").fadeTo(750, 0, function(){$(this).hide();});'>
            <label class="align_to_top w-100 pb-1 d-flex justify-content-between justify-items-center border-bottom" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                style="cursor: pointer;">
                <small>Добави продукти за приготвянето на това ястие</small>
                <i class="fas fa-caret-down"></i>
            </label>
        </div>
        <div id="collapseOne" class="collapse _show" aria-labelledby="headingOne" data-parent="#accordionWrapper">
        <div class="">
            <h6><small>Категории продукти</small></h6>
            <div class="border-bottom" id="accordionIngredients">
@foreach($ingredients_groups as $group)
    <?php
    $_ingredients = $ingredients_collection->where('group', $group)->toArray();
    // dd($ingredients);
    ?>
    <div class="">
        <div class="" id="_{{$group}}">
            <h5 class="d-flex justify-content-between justify-items-center mb-0 px-1 border-top btn btn-link text-left text-capitalize"
                data-toggle="collapse" data-target="#{{$group}}" aria-expanded="true" aria-controls="{{$group}}">
                {{$groups_data[$group]['bg_name']}}
                <span><i class="fas fa-chevron-right text-dark "></i></span>
            </h5>
        </div>
        <div id="{{$group}}" class="collapse _show" aria-labelledby="_{{$group}}" data-parent="#accordionIngredients">
            <div class="py-0 px-2">
                <div class="d-flex">
                    <select _multiple class="form-control  w-50 ingredient">
                        <option>избери продукт</option>
                        <option disabled></option>
                        @foreach($_ingredients as $ingredient)
                            <option value="{{$ingredient['id']}}, {{$ingredient['bg_name']}}" @if(false) disabled @endif>{{$ingredient['bg_name']}}</option>
                        @endforeach
                    </select>
                    <input type="number" class="form-control w-25 pr-0 quantity" placeholder="количество">
                    <select _multiple class="form-control w-25 mx-1 unit">
                        <option>мярка</option>
                        @foreach(['грама', 'милилитра', 'броя', 'глави', 'скилидки', 'връзка'] as $unit)
                        <option value="{{$unit}}">{{$unit}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="product_id">
                </div>
                <div class="form-group mt-2 text-right">
                    <button type="button"
                            class="py-0 align_to_top btn btn-outline-secondary btn-sm"
                            onclick="add_product('{{$group}}')"
                            data-toggle="collapse" data-target="#{{$group}}" aria-expanded="true" aria-controls="{{$group}}">
                        Добави продукта
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

        </div>
    </div>
    </div>
</div>
<style>
.product-success {
    color: brown;
}
.product-added {
    color: #545b62;
    -webkit-transition: all 1.5s; /* Safari */
    transition: all 1.5s;
}
</style>
<script>
$(".align_to_top").click(function() {
    // $([document.documentElement, document.body]).animate({
    //     scrollTop: ($("#products-fake-wrapper").offset().top)
    // }, 350, 'easeOutExpo');
    $("#products-fake-wrapper").html(`<h5 class="m-0 pt-5 pb-2 font-weight-normal">Списък с продукти</h5>`);
});

    $(document).ready(function(){
        // product++;
        // $( 'table.with.products tr').each(function( index ) {
        //     let id = $(this).find('.id').text();
        //     let name = $(this).find('.name').text();
        //     let quantity = $(this).find('.quantity').text();
        //     let unit = $(this).find('.unit').text();
        //     json = JSON.parse(`{"id":"${id}", "name":"${name}", "unit":"${unit}", "quantity":"${quantity}"}`);
        //     products.push(json);
        // });
        // $('[name=ingredients]').val( JSON.stringify(products) );
    })

    let products = [];
    let product = 1;

    function add_product(id) {
        ingredient = $('#'+id+' .ingredient').val();
        ingredient = ingredient.split(",");
        unit = $('#'+id+' .unit').val();
        quantity = $('#'+id+' .quantity').val();
        json = JSON.parse(`{"ingredient_id":"${ingredient[0]}", "name":"${ingredient[1]}", "unit":"${unit}", "quantity":"${quantity}"}`);
        products.push(json);
        $('table.products tr:last-child').after(
            `
            <tr class="product-success" id="product${ingredient[1].replace(/[ ()]/g, '-').toLowerCase()}">
                <td class="px-0 py-1">
                    <div class="form-group m-0 px-1 d-flex justify-content-between">
                        <span id="product_${products.length}" class="show-product">
                            <span class="id d-none">${ingredient[0]}</span>
                            <span class="name">${ingredient[1]}</span> -
                            <small>
                            <i>
                                <span class="quantity">${quantity}</span>
                                <span class="unit">${unit}</span>
                            </i>
                            </small>
                        </span>
                        <span onclick="removeProduct('${ingredient[1].replace(/[ ()]/g, '-').toLowerCase()}')"><i class="fas fa-times"></i></span>
                    </div>
                </td>
            </tr>`
        );
        product++;
        update_products();
        setTimeout(function(){
            $('#product'+ingredient[1].replace(/[ ()]/g, '-').toLowerCase()).addClass('product-added');
        }, 1050)
    }
    
    function removeProduct(productName) {
        products = [];
        product--;
        $('tr#product'+productName).remove();
        $( 'table.products tr').each(function( index ) {
            if($(this).html().length != 0) {
                let id = $(this).find('.id').text();
                let name = $(this).find('.name').text();
                let quantity = $(this).find('.quantity').text();
                let unit = $(this).find('.unit').text();
                json = JSON.parse(`{"id":"${id}", "name":"${name}", "unit":"${unit}", "quantity":"${quantity}"}`);
                products.push(json);
            }
        });
        update_products();
    }

    function update_products() {
        $('[name=ingredients]').val( JSON.stringify(products) )
    }
</script>