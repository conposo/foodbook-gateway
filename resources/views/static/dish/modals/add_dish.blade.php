<?php
// dd($dish);
?>
<div class="modal fade" id="addDishModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="m-0 p-0" action="{{ route('meal-dish-add') }}" method="POST">
                @csrf
                
                <input type="hidden" name="dish_id" value="{{ $dish['id'] }}">
                <input type="hidden" name="dish_type" value="{{ isset($dish['owner_type']) && $dish['owner_type'] ? $dish['owner_type'] : 'S' }}">
                

                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal">Добави</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="input-group-prepend" style="border-bottom: 1px solid rgba(192, 192, 192, 0.15);">
                        <span id="dish_bg_name" class="h4 flex-wrap">{{ $dish['bg_name'] }}</span>
                    </div>
                    <div class="input-group flex justify-content-between align-items-center">
                        <span class="mr-2">
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
                            <i class="w-75">за <span>{{$GLOBALS['date_formatted']}}</span></i>
                        </span>
                        <select class="custom-select d-inline-flex p-0 border-0" name="dish_count">
                            <option value="1">1 бр</option>
                            <option value="2">2 бр</option>
                            <option value="3">3 бр</option>
                            <option value="4">4 бр</option>
                            <option value="5">5 бр</option>
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
                
                <div class="modal-footer  justify-content-between">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Отказ</button>
                    <button type="submit" class="btn btn-info _text-white">Добави</button>
                </div>
            
            </form>
        </div>
    </div>
</div>