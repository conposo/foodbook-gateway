
<?php if( isset($_GET['modal']) && $_GET['modal'] == 'open' ): ?>
<script>
$(document).ready(function() {
  $('#showCategories').modal('show')
})
</script>
<?php endif; ?>

<div class="modal fade" id="showCategories" tabindex="-1" role="dialog" style="background-color: floralwhite;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px; background-color: rgb(253, 245, 235);">

      <div class="_modal-header">
        <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body px-5 pb-5">
            <h1 class="mb-5 text-center" style="font-size:1.6rem;">{{$restaurant['business_name']}}</h1>
            <h2 class="mb-5 pb-2 btn-sm rounded-0 px-0 text-black-50 border-bottom text-uppercase font-weight-normal text-center">меню</h2>

            @if(isset($restaurant['menu']))
                <?php
                $menu_collection = collect($restaurant['menu']);
                $categories = array_unique($menu_collection->pluck('category_slug')->toArray());
                // dd($categories, $menu_collection);
                ?>

                @foreach($categories as $category)
                    @if(isset($GLOBALS['categories'][$category]))
                        <h4 class="d-flex justify-content-center align-items-center mt-5 mb-3 text-uppercase font-weight-normal">
                            <span class="" style="color:brown; font-size: 0.5rem;">
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                            </span>
                            <span class="mx-2">{{$GLOBALS['categories'][$category]['bg_name']}}</span>
                            <span class="" style="color:brown; font-size: 0.5rem;">
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                            </span>
                        </h4>
                    @else
                        <h5 class="d-flex justify-content-center align-items-center mt-5 mb-3 text-uppercase font-weight-normal">
                            <span class="" style="color:brown; font-size: 0.5rem;">
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                            </span>
                            <span class="mx-2">без категория</span>
                            <span class="" style="color:brown; font-size: 0.5rem;">
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                                <i class="fas fa-star-of-life"></i>
                            </span>
                        </h5>
                    @endif

                    <?php $dishes = $menu_collection->where('category_slug', $category)->toArray() ?>
                    
                    @foreach($dishes as $dish)
                        <?php $dish = collect($dish)->toArray(); ?>

                        <div class="d-flex justify-content-center align-items-center position-relative mb-3 rounded dish text-center"
                                style="_background-size:cover; _background-image:url('/images/restaurants/{{ $restaurant['slug'] }}/main.jpeg')">

                            <a class="ml-4 d-block _pt-2" href="#{{ route('dish', $dish['dish_id'] ? $dish['dish_id'] : $dish['id']) }}">
                                <span class="d-block py-0">{{ $dish['dish_name'] }}</span>
                            </a>
                            <span class="ml-1" style="color:brown; font-size:1rem;">
                                <?php
                                echo $combined_price =  App\Http\Controllers\Controller::combinePriceParts($dish['dish_price']);
                                ?>
                                <small style="margin-bottom: -3px;">лв.</small>
                            </span>

                            <form class="ml-2 p-0 blabla" action="{{ route('reservation-dish-add', ['id' => $reservation['id']]) }}" method="POST">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="dish_id" value="{{$dish['dish_id']}}">
                                <input type="hidden" name="guest_id" value="{{$current_user_guest_data['id']}}">
                                <input type="hidden" name="reservation_id" value="{{$reservation['id']}}">

                                <button type="submit" class="text-dark btn btn-link btn-sm p-0" style="font-size: 28px; line-height: 1; margin-top: -10px; font-weight: 300;">+</button>
                            </form>
                        </div>
                    
                    @endforeach

                @endforeach

            @endif
      </div>

    </div>
  </div>
</div>
