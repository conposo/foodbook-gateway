
        <!-- date / time / user_type / user_id / dish_type / dish_id -->
    <script>
    function build_form(dish_type, dish_id, dish_bg_name) {

        $('#dish_type').val(dish_type);
        $('#dish_id').val(dish_id);

        $('#dish_bg_name').text(dish_bg_name);
    }
    </script>

    <div class="modal" id="addDishModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <form class="m-0 p-0" action="{{ route('meal-dish-add') }}" method="POST">
            @csrf

            <input type="hidden" id="dish_type"  name="dish_type">
            <input type="hidden" id="dish_id"  name="dish_id">

            <div class="modal-header">
                <h5 class="text-uppercase small modal-title"><span class="font-weight-normal">Добави към календара</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="input-group-prepend" style="border-bottom: 1px solid rgba(192, 192, 192, 0.15);">
                    <span id="dish_bg_name" class="h4 flex-wrap"></span>
                </div>

                <div class="input-group d-flex justify-content-between align-items-center">
                    <span class="mr-4">
                        за
                        <span class="mx-1 font-weight-bold">
                        @php($meal = \Illuminate\Support\Facades\Cookie::get('meal'))
                        @switch($meal)
                            @case('breakfast')
                                закуска
                                @break
                            @case('lunch')
                                обяд
                                @break
                            @case('dinner')
                                вечеря
                                @break
                        @endswitch
                        </span>
                        <i class="_w-75"><span> </span></i>
                    </span>
                    <select class="custom-select d-flex p-0 border-0" name="quantity">
                        <option value="1" selected>1 бр</option>
                        <option value="2" disabled>2 бр</option>
                        <option value="3" disabled>3 бр</option>
                        <option value="4" disabled>4 бр</option>
                        <option value="5" disabled>5 бр</option>
                    </select>
                </div>

                @if( isset($GLOBALS['isHousehold']) && $GLOBALS['isHousehold'] )
                    <div>                    
                        към
                        <label class="btn btn-sm mb-1" for="personal">личното <input type="radio" name="user_type[]" value="user" id="personal"> </label>
                        или
                        <label class="btn btn-sm mb-1" for="common">общото <input type="radio" name="user_type[]" value="household" id="common"> </label>
                        меню
                    </div>
                    <script>
                    $('input:radio').change(function(){
                        $('input:submit').prop('disabled', false);
                        console.info( $('button:submit').prop('disabled') )
                    })
                    </script>
                @else
                    <input type="hidden" name="user_type[]" value="user">
                    към личното меню или 
                    <a href="{{route('household')}}" class="">създай своето домакинство</a>
                    <script>
                        $(document).ready(function(){
                                $('input:submit').prop('disabled', false);
                        })
                    </script>
                @endif

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Отказ</button>
                <input type="submit" class="btn btn-outline-dark" disabled value="Добави">
            </div>

        </form>
    </div>
    </div>
    </div>
