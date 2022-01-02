
<div id="products-fake-wrapper">
    <h6 class="m-0 pt-3 pb-2">Списък с продукти</h6>
</div>

<table class="with products table w-100 mb-3 border-bottom">
    <?php $recipe_ingredients = $dish['recipe']['ingredients']; ?>
    @php($product_num = 1)
    @if($recipe_ingredients)
        @foreach($recipe_ingredients as $ingredient)
            <?php //dd($ingredient); ?>
            @if( isset($ingredient['ingredient_id']) && $ingredient['ingredient_id'] && $ingredient['bg_name'] )
            <tr id="product{!! mb_strtolower(str_replace([" ", "(", ")"], "-", $ingredient['bg_name'])) !!}"
                class="product-success product-added">
                <td class="px-0 py-1">
                    <div class="form-group m-0 px-1 d-flex justify-content-between">
                        <span id="product_{{$product_num}}">
                            <span class="id d-none">{{$ingredient['id']}}</span>
                            <span class="name">{{$ingredient['bg_name']}}</span> -
                            <small>
                                <i>
                                    <span class="quantity">{{$ingredient['quantity']}}</span>
                                    <span class="unit">{{$ingredient['unit']}}</span>
                                </i>
                            </small>
                        </span>
                        <span onclick="removeProduct('{!! mb_strtolower(str_replace([" ", "(", ")"], "-", $ingredient['bg_name']))!!}')"><i class="fas fa-times"></i></span>
                    </div>
                </td>
            </tr>
            @else
            <tr>
                <td class="px-0 py-1">
                    <span class="i small text-uppercase">something missing</span>
                    <?php var_dump($ingredient); ?>
                </td>
            </tr>
            @endif
        @endforeach
    @else
    <tr></tr>
    @endif
</table>

@include('user.dishes.partials.add.ingredients')

<script>

// let products = [];
// let product = 1;

$(document).ready(function(){
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
});

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