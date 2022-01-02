
@if( false )
<script>
    $(document).ready(function() {

    })
</script>
@endif

<form class="mb-0" action="{{route('save-position')}}" method="POST">
    @csrf

    <div class="py-2 border-bottom">
            <div style="opacity: 10.5" class="d-flex justify-content-between">
                <div>
                    <span class="label mr-2">Позиция:</span>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="CHEF" name="position[]" @if( in_array('CHEF', collect($positions)->pluck('position')->toArray()) ) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox1">CHEF</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="WAITER" name="position[]" @if( in_array('WAITER', collect($positions)->pluck('position')->toArray()) ) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox2">Сервитьор</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="BARRISTA" name="position[]" @if( in_array('BARRISTA', collect($positions)->pluck('position')->toArray()) ) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox3">Барман</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="MANAGER" name="position[]" @if( in_array('MANAGER', collect($positions)->pluck('position')->toArray()) ) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox4">Управител</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="CHEF2" name="position[]" @if( in_array('CHEF2', collect($positions)->pluck('position')->toArray()) ) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox5">Помощник готвач</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="CHEF3" name="position[]" @if( in_array('CHEF3', collect($positions)->pluck('position')->toArray()) ) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox6">Помощник кухня</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <button class="px-1 btn btn-outline-dark py-0" type="submit">Запиши<i class="ml-1 fas fa-user-check"></i></button>
                </div>
            </div>
            <a class="d-none _flex w-100 justify-content-between align-items-center text-dark"
                data-toggle="collapse" href="#collapse_p_i" role="button" aria-expanded="false" aria-controls="collapse_p_i">
                <i class="fas fa-chevron-right"></i>
            </a>
        <div class="d-none collapse" id="collapse_p_i">
            <input class="_form-control mt-1 py-0" type="text" name="positions-description" value="">
        </div>
    </div>
    <div id="more" class="collapse">
        Посочвайки позициите, на които можеш да работиш в някое заведение ти дава възможност да бъдеш включен в списъци за отворени работни позиции обявени от бизнесите в платформата.
    </div>

    <div id="blabla_position_more" class="py-1 d-flex justify-content-start align-items-center">
        <button class="px-1 btn btn-outline-dark py-0 mr-2" type="button"
            href="#more" role="button" 
            data-toggle="collapse" aria-expanded="false" aria-controls="collapse_p_i"
            onclick="$('#blabla_position_more').removeClass('d-flex').hide()"
            >Разбери повече</button>
    </div>
</form>
