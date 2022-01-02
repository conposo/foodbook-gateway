
@extends('layouts.app')

@section('content')

<?php
$dish = $dish->toArray();
// dd($dish, $dish_type);
?>

<h5 class="my-3 pb-2 text-center _border-bottom">Редактираш</h5>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col card py-3">

        <h5 class="mb-3 pb-2 _text-center _border-bottom">
            @if( isset($dish['owner_type']) && $dish['owner_type'] == 'B' )
                <a class="text-dark d-flex align-items-center" href="{{ route('restaurant-settings', ['slug' => $dish['owner_id']]) }}"><i class="mr-1 fas fa-chevron-left"></i> назад</a>
            @else
                <a class="text-dark d-flex align-items-center" href="{{route('recipes')}}"><i class="mr-1 fas fa-chevron-left"></i> назад</a>
            @endif
        </h5>
        
        <form action="{{ route('recipe-update', ['dish_type' => $dish_type, 'dish_id' => $dish['id']]) }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            @method('PATCH')

            <input type="hidden" name="steps" value="{{json_encode($dish['recipe']['steps'])}}">
            <input type="hidden" name="ingredients">
            <input type="hidden" name="recipe_id" value="{{$dish['recipe_id']}}">
            
            <div class="d-flex justify-content-between align-items-end mb-3">
                <span class="d-flex justify-content-between align-items-start">
                    <h1 class="m-0">
                        {{$dish['bg_name']}}
                    </h1>
                    <span style="font-size: 12px;">
                        <a class="text-dark" href="{{ route('dish', $dish['slug']) }}">
                        <i class="fas fa-external-link-alt"></i>
                        </a>
                    </span>
                </span>
                <span>
                    <input class="form-check-input" type="checkbox" id="inlineFormCheck" name="public"
                    <?= isset($dish['public']) ? $dish['public'] ? 'checked': '' : '' ?>
                    >
                    <label class="form-check-label" for="inlineFormCheck">
                        <small>публична</small>
                        <sup><i class="fas fa-info-circle"></i></sup>
                    </label>
                </span>
            </div>

            <div class="form-group">
                <label class="pl-1" for="bg_name" onclick="$('#bg_name').removeAttr('disabled')"><small>Промени името</small><sup><i class="ml-1 fas fa-info-circle"></i></sup></label>
                <input type="hidden" class="form-control" name="bg_name" value="{{$dish['bg_name']}}" >
                <input type="text" class="form-control" id="bg_name" name="bg_name" value="{{$dish['bg_name']}}" disabled>
            </div>


            <div class="form-group">
                <label for="category"><small>Описание</small></label>
                <textarea class="form-control" name="description" rows="3">{{$dish['description']}}</textarea>
            </div>

            @include('user.dishes.partials.add.pictures.edit')
            @include('user.dishes.partials.add.pictures.add')

            @include('user.dishes.partials.ingredients.dish')


            <label class="_align_to_top w-100 pb-1 d-flex justify-content-between justify-items-center border-bottom"
                    data-toggle="collapse" data-target="#collapseTextareas" aria-expanded="true" aria-controls="collapseTextareas"
                    style="cursor: pointer;">
                <small>Редактирай стъпките за приготвянето на това ястие</small>
                <i class="fas fa-caret-down"></i>
            </label>
            <div id="collapseTextareas" class="collapse show">
                <?php $steps = $dish['recipe']['steps']; ?>
                <?php //dd($steps); ?>
                <table class="steps w-100">
                @if($steps)
                    @php($i = 1)
                    @foreach($steps as $step)
                        <tr id="step{{$i}}">
                            <td>
                            <div class="form-group mb-1">
                                <label class="d-flex justify-content-between" for="step_{{$i}}">Стъпка {{$i}} 
                                    <span onclick="removeStep({{$i}})"><i class="fas fa-times"></i></span>
                                </label>
                                <textarea id="step_{{$i++}}" class="form-control steps" rows="3">{{$step['text']}}</textarea>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </table>
                <div class="form-group mb-5 text-right">
                    <button type="button" class="btn btn-outline-secondary btn-sm mt-3 add_step" id="add_step_button" onclick="add_step()">Добави нова стъпка</button>
                </div>
            </div>

            <div class="form-group d-flex justify-content-end my-5 pt-5 border-top">
                <button type="button" class="btn btn-link text-danger btn-sm" data-toggle="modal"
                    data-target="#deleteDish">Изтрий</button>
                <button type="submit" class="btn btn-primary" style="background-color: #4267b2; border-color: #4267b2;">Запиши</button>
            </div>

        </form>

        <h5 class="m-0">
            <a class="text-dark d-flex align-items-center" href="{{route('recipes')}}"><i class="mr-1 fas fa-chevron-left"></i> назад</a>
        </h5>
        </div>
    </div>
</div>

@include('user.dishes.modals.delete-dish')


<script>

let steps = [];
let step = 1;

$(document).ready(function(){
    update_steps();
})

function add_step() {
    if(steps.length === 0) step = 0;
    $('table.steps').append(
        `<tr id="step${step+1}"><td>
            <div class="form-group mt-2">
                <label class="d-flex justify-content-between" for="step_${step+1}">
                    Стъпка ${step+1} <span onclick="removeStep(${step+1})"><i class="fas fa-times"></i></span>
                </label>
                <textarea id="step_${step+1}" class="form-control steps" rows="3"></textarea>
            </div>
        </td></tr>`
    );
    step++;
}

function removeStep(stepId) {
    step--;
    $('table.steps tr#step'+stepId).remove();
    $( "table.steps tr" ).each(function( index ) {
        let next_index = index+1;
        $(this).attr('id', 'step'+next_index);
        $(this).find('label').attr('for', 'step_'+next_index).html(`Стъпка ${next_index} <span onclick="removeStep(${next_index})"><i class="fas fa-times"></i></span>`);
        $(this).find('label textarea').attr('id', 'step_'+next_index);
    });
    update_steps();
}

function update_steps() {
    steps = [];
    $('table.steps tr textarea').each(function( index ) {
        console.log(index);
        item = JSON.parse(`{"step": "${step}", "text": "${$(this).val()}"}`.replace(/\r?\n|\r/g, ' '));
        steps.push(item);
    });
    $('[name=steps]').val( JSON.stringify(steps) )
}

$(document).on('blur', 'table.steps tr textarea', function () {
    console.log($(this));
    update_steps();
});

</script>

@endsection