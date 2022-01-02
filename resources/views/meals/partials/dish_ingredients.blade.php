
<div class="">
    <button class="d-none btn btn-link" type="button" data-toggle="collapse" data-target=".manage" aria-expanded="true" aria-controls="collapseOne">
        Необходими продукти
    </button>
    <div id="collapseOne" class="manage _ingredients collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            
        <div class="list ingredients">
            <?php
            if( isset($dish['recipe']) ):
                $ingredients = $dish['recipe']['ingredients'];

                $check_list_array = [];
                if(isset($GLOBALS['list_data']))
                    $check_list_array = $GLOBALS['list_data']['items'];

                if($GLOBALS['isHousehold'] && !isset($_GET['user_type']))
                {
                    if(isset($GLOBALS['household_list_data']))
                        $check_list_array = $GLOBALS['household_list_data']['items'];
                }
                foreach($ingredients as $ingredient):
                    ?>
                    <div class="pl-1 my-1 d-flex flex-fill justify-content-between align-items-center" style="_font-size: 10px">
                        <?php $quantity = (int) $ingredient['quantity'] ?>
                        <span>
                            <span style="font-weight:500;text-shadow: 0 0 12px rgba(0, 0, 0, 0.5);">
                            @if(isset($ingredient['bg_name'])) {{$ingredient['bg_name']}} @else неизвестен продукт @endif
                            </span>
                            <i class="ml-2">
                            @if(isset($quantity)) {{$quantity*$_meal_data['quantity']}} @endif
                            @if(isset($ingredient['unit'])) {{$ingredient['unit']}} @endif
                            </i>
                        </span>
                        <?php
                        $added = false;
                        foreach($check_list_array as $_ingredient)
                        {
                            // var_dump($_ingredient['ingredient_id'], $ingredient['id']);
                            if($_ingredient['ingredient_id'] == $ingredient['id'])
                            {
                                $added = true;
                                break;
                            }
                        }
                        ?>
                        <<?= $added ? ('div') : ('form'); ?> class="m-0" action="{{route('list-add-item')}}@if(isset($_GET['user_type']))?user_type=user @endif" method="POST">
                            @csrf
                            
                            @if( $GLOBALS['isHousehold'] && !isset($_GET['user_type']) )
                            <input type="hidden" name="user_type" value="household">
                            <input type="hidden" name="user_type_id" value="{{$GLOBALS['household_id']}}">
                            @elseif(isset($_GET['user_type']) && $_GET['user_type'] == 'user')

                            @endif

                            <input type="hidden" name="ingredient_id" value="{{ $ingredient['id'] }}">
                            <input type="hidden" name="name" value="@if(isset($ingredient['bg_name'])) {{$ingredient['bg_name']}} @endif">
                            <input type="hidden" name="quantity" value="{{ $quantity*$_meal_data['quantity'] }}">
                            <input type="hidden" name="unit" value="{{ $ingredient['unit'] }}">

                            <button class="btn btn-link <?= isset($ingredient['added']) ? ('_disabled') : (''); ?> btn-sm" type="submit" style="padding-right: 6px;">
                                <i class="<?= $added ? ('fas fa-clipboard-check text-success" style="padding-right: 2px; font-size: 14px; background-color: white; padding-left: 3px; padding-top: 2px; padding-bottom: 2px; border-radius: 2px;"') : ('fas fa-cart-arrow-down text-white"'); ?>></i>
                            </button>
                        </<?= $added ? ('div') : ('form'); ?>>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        
    </div>
</div>