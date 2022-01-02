
  <div class="d-flex align-items-stretch border-left col-9 px-4">
    <div class="tab-content d-flex w-100 justify-content-center" id="v-pills-tabContent">
    @php($i = 1)
    @foreach($GLOBALS['categories'] as $category)
        <?php
        $dishes = collect($data['data'])->where('category', $category['slug'])->toArray();
        ?>
        <div class="w-100 justify-content-center h-100 tab-pane fade @if($i++ == 1) show active @endif" id="v-pills-{{$category['slug']}}" role="tabpanel" aria-labelledby="v-pills-{{$category['slug']}}-tab">
        <div class="w-100 justify-content-center h-100 d-flex align-items-end flex-column">
            <h4 class="mb-5 w-100 d-flex justify-content-center align-items-center text-uppercase text-center">
                <a href="{{ route('category', $category['slug']) }}">{{$category['bg_name']}}</a>
                @if(isset($category['custom']))
                <form class="d-inline" action="{{route('user-delete-category')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="slug" value="{{$category['slug']}}">
                    <button class="btn btn-link" type="submit"><i class="far fa-trash-alt"></i></button>
                </form>
                @endif
            </h4>

            @foreach($dishes as $dish)
            <div class="w-100 border-bottom d-flex w-100 justify-content-between">
                <span>
                    {{$dish['bg_name']}}
                    <a href="{{route('recipe-update', ['dish_type' => 'P', 'dish_id' => $dish['slug']])}}"><i class="far fa-edit"></i></a>
                </span>
                <form class="ml-3 d-inline" action="{{route('recipe-delete', ['dish_type' => 'P', 'dish_id' => $dish['id']])}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="category" value="{{$category['slug']}}">
                    
                    <button class="btn py-0 text-" type="submit"><i class="far fa-trash-alt"></i></button>
                </form>
            </div>
            @endforeach
            
            <div class="w-100 mt-auto pt-5">
                <h6 class="my-1 pb-2 text-center text-black-50 border-bottom font-weigh-lighter">ново ястие</h6>
                <!-- <h5 class="pb-2 text-center border-bottom">Добави ново ястие</h5> -->
                <div class="text-center">
                    <a class="d-block text-black-50 add_"
                        style="cursor:pointer;"
                        data-toggle="modal"
                        data-target="#showAddDish"
                        onclick="$('#category_hidden_input').val('{{$category['slug']}}')">
                        <span style="font-size:3.6rem; font-weight:100;">+</span>
                    </a>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    </div>
  </div>
  
  @include('user.dishes.modals.add-dish')