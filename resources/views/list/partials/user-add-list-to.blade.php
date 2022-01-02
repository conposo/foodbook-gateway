    <div class="row _border-top">
        <p class="w-100 mb-2 text-center"><small><i>Добави тези продукти към списъка за</i></small></p>
        <div class="d-flex d-fill justify-content-between alaign-items-center col-10 col-md-8 mx-auto">
            @if(Request::segment(2) != 'weekly')
            <form class="d-flex w-75 mx-auto" action="{{ route('list-update') }}" method="POST">
                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="weekly">
                <input type="hidden" name="shopping_list_id" value="{{$ingredient['shopping_list_id']}}">

                <button class="btn btn-outline-secondary btn-sm w-100 mx-auto" type="submit">седмицата</button>
            </form>
            @endif
            <form class="d-flex w-75 @if(Request::segment(2) == 'weekly') mx-auto @else ml-3 @endif" action="{{ route('list-update') }}" method="POST">
                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="monthly">
                <input type="hidden" name="shopping_list_id" value="{{$ingredient['shopping_list_id']}}">

                <button class="btn btn-outline-secondary btn-sm w-100 mx-auto" type="submit">месеца</button>
            </form>
        </div>
    </div>