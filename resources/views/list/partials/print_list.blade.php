

    <div class="wrapper d-flex align-items-center">
        <div class="flex-fill align-items-center position-relative my-1">
            <div class="d-flex flex-fill flex-column">
                <div class="_ingredients">

                @foreach($checked as $ingredient)
                <div class="ingredient text-stroke text-black-50 d-flex flex-fill justify-content-between align-items-center border-bottom" style="font-size: 10px">
                    <div class="form-check form-check-inline btn-sm px-0 px-sm-2">
                        <input class="mr-1 mr-sm-2 form-check-input" type="checkbox" checked disabled>
                        <label class="mr-1 mr-sm-2 form-check-label">
                            {{ $ingredient['name'] }}
                            <span class="ml-2" style="color: brown;">
                                <?php
                                $ingredient_entities_unit = $ingredient['unit'];
                                switch( $ingredient_entities_unit )
                                {
                                    case 'грам':
                                    $unit = 'гр.';
                                    break;
                                    case 'грама':
                                    $unit = 'гр.';
                                    break;
                                    case 'брой':
                                    $unit = 'бр.';
                                    break;
                                    case 'броя':
                                    $unit = 'бр.';
                                    break;
                                    case 'глава':
                                    $unit = 'гл.';
                                    break;
                                    case 'глави':
                                    $unit = 'гл.';
                                    break;
                                    case 'топка':
                                    $unit = 'бр.';
                                    break;
                                    case 'топки':
                                    $unit = 'бр.';
                                    break;
                                    case 'скилидка':
                                    $unit = 'скл.';
                                    break;
                                    case 'скилидки':
                                    $unit = 'скл.';
                                    break;
                                    case 'чаена лъжица':
                                    $unit = 'ч.л.';
                                    break;
                                    case 'чаени лъжици':
                                    $unit = 'ч.л.';
                                    break;
                                    case 'чаени чаша':
                                    $unit = 'ч.ч.';
                                    break;
                                    case 'чаени чаши':
                                    $unit = 'ч.ч.';
                                    break;
                                    case 'супена лъжица':
                                    $unit = 'с.л.';
                                    break;
                                    case 'супени лъжици':
                                    $unit = 'с.л.';
                                    break;
                                    case 'листо':
                                    $unit = 'лс.';
                                    break;
                                    case 'листа':
                                    $unit = 'лс.';
                                    break;
                                    break;
                                    case '':
                                    $unit = '';
                                    break;
                                    case '':
                                    $unit = '';
                                    break;
                                    case '':
                                    $unit = '';
                                    break;
                                    default:
                                        $unit = $ingredient_entities_unit;
                                }?>
                                {{ $ingredient['quantity'] }}
                                {{ $unit }}
                            </span>
                        </label>
                    </div>

                    <form id="form_{{$ingredient['id']}}" action="{{ route('list-update-item') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="shopping_list_id" value="{{$ingredient['shopping_list_id']}}">
                        <input type="hidden" name="ingredient_id" value="{{$ingredient['ingredient_id']}}">
                        <input type="hidden" name="checked" value="0">

                        <div class="m-0 form-check form-check-inline">
                            <input class="d-none form-check-input" type="checkbox" id="inlineCheckbox{{$ingredient['id']}}" name="id" value="{{$ingredient['id']}}">
                            <label class="form-check-label" for="inlineCheckbox{{$ingredient['id']}}">
                                <i class="btn btn-sm fas fa-undo-alt"></i>
                            </label>
                        </div>
                    </form>
                </div>
                @endforeach
                
                @foreach($unchecked as $ingredient)
                <div class="ingredient d-flex flex-fill justify-content-between align-items-center border-bottom" style="font-size: 10px">

                    <form id="form_{{$ingredient['id']}}" action="{{ route('list-update-item') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="shopping_list_id" value="{{$ingredient['shopping_list_id']}}">
                        <input type="hidden" name="ingredient_id" value="{{$ingredient['ingredient_id']}}">
                        <input type="hidden" name="checked" value="1">

                        <div class="form-check form-check-inline btn-sm px-0 px-sm-2">
                            <input class="mr-1 mr-sm-2 form-check-input" type="checkbox" id="inlineCheckbox{{$ingredient['id']}}" name="id" value="{{$ingredient['id']}}">
                            <label class="mr-1 mr-sm-2 form-check-label" for="inlineCheckbox{{$ingredient['id']}}">
                                {{ $ingredient['name'] }}
                                <span class="ml-1" style="color: brown;">
                                    <?php
                                    $ingredient_entities_unit = $ingredient['unit'];
                                    switch( $ingredient_entities_unit )
                                    {
                                        case 'грам':
                                        $unit = 'гр.';
                                        break;
                                        case 'грама':
                                        $unit = 'гр.';
                                        break;
                                        case 'брой':
                                        $unit = 'бр.';
                                        break;
                                        case 'броя':
                                        $unit = 'бр.';
                                        break;
                                        case 'глава':
                                        $unit = 'гл.';
                                        break;
                                        case 'глави':
                                        $unit = 'гл.';
                                        break;
                                        case 'топка':
                                        $unit = 'бр.';
                                        break;
                                        case 'топки':
                                        $unit = 'бр.';
                                        break;
                                        case 'скилидка':
                                        $unit = 'скл.';
                                        break;
                                        case 'скилидки':
                                        $unit = 'скл.';
                                        break;
                                        case 'чаена лъжица':
                                        $unit = 'ч.л.';
                                        break;
                                        case 'чаени лъжици':
                                        $unit = 'ч.л.';
                                        break;
                                        case 'чаени чаша':
                                        $unit = 'ч.ч.';
                                        break;
                                        case 'чаени чаши':
                                        $unit = 'ч.ч.';
                                        break;
                                        case 'супена лъжица':
                                        $unit = 'с.л.';
                                        break;
                                        case 'супени лъжици':
                                        $unit = 'с.л.';
                                        break;
                                        case 'листо':
                                        $unit = 'лс.';
                                        break;
                                        case 'листа':
                                        $unit = 'лс.';
                                        break;
                                        break;
                                        case '':
                                        $unit = '';
                                        break;
                                        case '':
                                        $unit = '';
                                        break;
                                        case '':
                                        $unit = '';
                                        break;
                                        default:
                                            $unit = $ingredient_entities_unit;
                                    } ?>
                                    {{ $ingredient['quantity'] }}
                                    {{ $unit }}
                                </span>
                            </label>
                        </div>
                    </form>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('list-item-delete', ['shopping_list_id' => $ingredient['shopping_list_id'], 'ingredient_id' => $ingredient['ingredient_id']]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-link btn-sm p-0 text-black-50 ml-2"
                                type="button"
                                data-toggle="modal"
                                data-target="#updateIngredientModal"
                                title="Update quantity"
                                onclick="build_form('{{$ingredient['shopping_list_id']}}', '{{$ingredient['ingredient_id']}}', '{{$ingredient['name']}}', '{{$ingredient['unit']}}', '{{$ingredient['quantity']}}')">
                                <!-- onclick="build_form('{{$ingredient['id']}}', '{{$ingredient['name']}}', '{{$ingredient['quantity']}}', '{{$ingredient['unit']}}', 'user', { { $GLOBALS['user_type_id']}})"> -->

                                <span class="btn btn-link btn-sm text-black-50">
                                    <i class="fas fa-pen"></i>
                                </span>
                            </button>
                            <button class="btn btn-link btn-sm text-black-50" type="submit"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach

                </div>
            </div>
        </div>
    </div>


<style>
.form-check-label {
    font-size: 18px;
}

.form-check-label > span {
    /* font-size: 14px; */
}

.form-check-label > i {
    font-size: 14px;
}

.text-stroke {
    text-decoration: line-through;
}
</style>
<script>
$('.form-check-input').change(function () {
    console.log($(this).val());
    $id = $(this).val();
    $( "#form_"+$id ).submit();
});
</script>