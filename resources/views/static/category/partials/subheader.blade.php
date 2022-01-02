
    <div class="row mt-5">
        <div class="col col-md-5 mx-auto d-flex justify-content-between align-items-end">
            <h4 class="category_name d-block text-capitalize">
                @if(isset($_GET['tags']))
                    @php($types = explode(',', is_array($_GET['tags'])? implode(',',$_GET['tags']): $_GET['tags']) )
                    @foreach($types as $type)
                        {{$GLOBALS['dish_types'][$category_name][$type]['bg_name']}}
                    @endforeach
                @else
                    {{$GLOBALS['dish_types'][$category_name][$type]['bg_name']}}
                @endif
                <span>{{$GLOBALS['dish_types'][$category_name][$type]['bg_name']}}</span>
            </h4>
            <span class="edit-category" 
                data-toggle="modal"
                data-target="#editCategory"
                data-category="{{ $GLOBALS['dish_types'][$category_name][$type]['slug'] }}">+</span>
        </div>
    </div>
