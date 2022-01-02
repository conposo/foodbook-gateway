
        <?php
        // dd($dishes);
        ?>
    @foreach($dishes as $dish)
    @if(is_array($dish))
        <!-- 
        <a href="{{route('dish', ['slug' => $dish['slug']])}}">{{ $dish['bg_name'] }}</a>

        <button
            data-toggle="modal"
            data-target="#addDishModal"
            title="Добави"
            onclick="build_form('user', 1, '2018-27-12', 11, 0, 'S', '{{$dish['id']}}', '{{$dish['bg_name']}}')">+</button>

        <div>
            <form action="{{route('meal-dish-add')}}" method="POST">
                @csrf                
                <input type="hidden" name="date" value="2018-12-17">
                <input type="hidden" name="time" value="17:00">

                <input type="hidden" name="user_type" value="user">
                <input type="hidden" name="user_id" value="1">

                <input type="hidden" name="dish_type" value="S">
                <input type="hidden" name="dish_id" value="{{$dish['id']}}">

                <button>add</button>
            </form>
        </div> -->

        <?php
        // dd($dish);
        $dish_id = $dish['id'];
        ?>
        <div class="item d-block px-2 position-relative" style="background-image: url('/images/other/foodbook.png'); background-size: 80%; background-repeat: no-repeat; background-position: center;">
            <div class="_bg owl-lazy position-relative d-flex-column _justify-content-between align-items-center mx-3"
                data-src="/images/dishes/{{$dish['slug']}}/main.jpeg">
                <a class="position-absolute d-flex align-items-end" href="{{ route('dish', $dish['slug']) }}">
                    <i class="fas fa-external-link-alt"></i>
                    <span class="position-relative px-1 py-1 w-100 _pb-5 bg_name">
                        {{ $dish['bg_name'] }}
                    </span>
                </a>
                <button
                    class="position-relative w-100 text-center btn btn-link btn-sm"
                    style="color:white; font-weight:300; font-size:2.8rem; line-height:2.8rem; text-shadow: 0 0 8px #000;"
                    data-toggle="modal"
                    data-target="#addDishModal"
                    title="Добави"
                    onclick="build_form('{{$dish_type}}', '{{$dish['id']}}', '{{$dish['bg_name']}}')">+</button>

                    <!-- user_type_id, dish_type, dish_id, dish_bg_name -->

            </div>
        </div>
    @endif
    @endforeach
