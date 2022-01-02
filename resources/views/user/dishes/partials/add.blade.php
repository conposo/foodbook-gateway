
    <form class="" action="{{route('recipe-add')}}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        @csrf

        <input type="hidden" name="dish_type" value="P">
        <input type="hidden" name="category" id="category_hidden_input">

        <input type="hidden" name="ingredients">
        <input type="hidden" name="steps">

        <div class="form-group">
            <label for=""><small>Избери име на ястието</small></label>
            <input type="text" class="form-control" name="bg_name" placeholder="напр. Патешки вратни пържоли" required>
        </div>
        
        <div class="form-group">
            <label for=""><small>Напиши нещо интересно за ястието</small></label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>
        
        @include('user.dishes.partials.add.pictures.add')

        <div id="products-fake-wrapper"></div>
        <div>
            <table class="products table border-bottom w-100 mb-2">
                <tr></tr>
            </table>
        </div>
        @include('user.dishes.partials.add.ingredients')
        @include('user.dishes.partials.add.steps')

        <div class="form-group form-check mt-5">
            <input type="checkbox" class="form-check-input" id="agreement">
            <label class="form-check-label" for="agreement"><i><small>Съгласявам се администратор да прегледа какви ги забърквам тука</small></i></label>
        </div>

        <div class="form-group text-center border-top pt-5 mb-5">
            <button type="submit" class="btn btn-primary"
                style="background-color: #4267b2;border-color: #4267b2;">Запиши</button>
        </div>
    </form>