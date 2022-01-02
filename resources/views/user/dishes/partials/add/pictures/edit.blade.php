<style>
.del_recipe_image:after {
    /* content: ''; */
    display:block;
    width: 25px;
    height: 25px;
    width: 100%;
    height: 100%;
    border: 1px solid red;
}
.del_recipe_image i {
    cursor: pointer;
    position: absolute;
    top: 10px;
    left: 10px;
    color: brown;
    background-color: white;
    padding: 5px;
}
</style>

@if($dish_pictures)
<label class="pl-1 mt-4 w-100 d-flex justify-content-start"
    style="">
    <small>Изтрий снимки</small>
</label>

<div class="d-flex flex-wrap mb-4 form-check form-check-inline border-bottom">
@foreach($dish_pictures as $recipe_picture)
    @if($recipe_picture[1] == 'main.jpeg')
        <label
            id="label{{ str_replace('.', '', $recipe_picture[1]) }}"
            class="del_recipe_image w-50 position-relative image picture{{ str_replace('.', '', $recipe_picture[1]) }} form-check-label"
            for="picture{{ str_replace('.', '', $recipe_picture[1]) }}"
            onclick="check_if_is_checked('{{ str_replace('.', '', $recipe_picture[1]) }}')"
            style="background-image:url(' {{ Storage::url('images/dishes/'.$recipe_picture[0].'/'.$recipe_picture[1]) }} ');">
            <input
                id="picture{{ str_replace('.', '', $recipe_picture[1]) }}"
                class="position-absolute form-check-input"
                type="checkbox"
                name="delete_pictures[]"
                value="dishes/{{ $recipe_picture[0] }}/{{ $recipe_picture[1] }}"
                style="top:0; left:0; z-index:-1; opacity:0;">
            <i class="far fa-trash-alt"></i>
        </label>
        @break
    @endif
@endforeach
@foreach($dish_pictures as $recipe_picture)
    @if($recipe_picture[1] != 'main.jpeg')
    <label
        id="label{{ str_replace('.', '', $recipe_picture[1]) }}"
        class="del_recipe_image w-50 position-relative image picture{{ str_replace('.', '', $recipe_picture[1]) }} form-check-label"
        for="picture{{ str_replace('.', '', $recipe_picture[1]) }}"
        onclick="check_if_is_checked('{{ str_replace('.', '', $recipe_picture[1]) }}')"
        style="background-image:url(' {{ Storage::url('images/dishes/'.$recipe_picture[0].'/'.$recipe_picture[1]) }} ');">
        <input
            id="picture{{ str_replace('.', '', $recipe_picture[1]) }}"
            class="position-absolute form-check-input"
            type="checkbox"
            name="delete_pictures[]"
            value="dishes/{{ $recipe_picture[0] }}/{{ $recipe_picture[1] }}"
            style="top:0; left:0; z-index:-1; opacity:0;">
        <i class="far fa-trash-alt"></i>
    </label>
    @endif
@endforeach
</div>
<style>
.image {
    border: 2px solid #fffaef;
    box-sizing: border-box;
    height: 100px;
    background-size: cover;
}
.selected
{
    -webkit-transition: all 0.75s; /* Safari */
    transition: all 0.75s;
    -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
    filter: grayscale(100%);
}
.selected::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.5);
    -webkit-transition: all 0.75s; /* Safari */
    transition: all 0.75s;
}
.clicked {
    position: relative;
}
.clicked::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 1);
}
</style>
<script>
function check_if_is_checked(id) {
    $('#label'+id).addClass('clicked');
    if( $( '#picture'+id ).is(':checked') ) {
        $( '.image.picture'+id ).addClass('selected');
    } else {
        $( '.image.picture'+id ).removeClass('selected');
    }
    setTimeout(function(){
        $('#label'+id).removeClass('clicked');
    }, 10)
}
</script>
@endif