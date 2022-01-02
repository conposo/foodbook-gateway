
    <script>
    $('.edit-category').click(function(){
        data_category = $(this).data('category');
        $('.types').each(function(){
            console.log($(this).attr('id'))
            if( $(this).attr('id') == data_category ) {
                $('label#'+$(this).attr('id')+'>input').prop("checked", true);
            }
            else {
                $('label#'+$(this).attr('id')+'>input').prop("checked", false);
            }
        })
    })
    </script>

    <div class="modal" id="editCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form class="m-0 p-0" action="" method="GET" >

        <div class="modal-header">
            <h5 class="modal-title">Избери какви ястия да се покажат</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="input-group _flex _justify-content-between _align-items-center">
                <?php
                foreach($GLOBALS['dish_types'][$category_name] as $type => $type_attributes):
                    if(isset($GLOBALS['dish_default_types'][$category_name][$type])):
                        ?>
                        <label id="{{$type_attributes['slug']}}" class="ml-3 types font-weight-bold">
                            <input type="checkbox" name="tags[]" value="{{$type_attributes['slug']}}">
                            {{$type_attributes['bg_name']}}
                        </label>
                        <?php
                    endif;
                endforeach;
                echo '<hr class="w-100">';
                foreach($GLOBALS['dish_types'][$category_name] as $type => $type_attributes):
                    if(!isset($GLOBALS['dish_default_types'][$category_name][$type])):
                        ?>
                        <label id="{{$type_attributes['slug']}}" class="ml-3 types">
                            <input type="checkbox" name="tags[]" value="{{$type_attributes['slug']}}">
                            {{$type_attributes['bg_name']}}
                        </label>
                        <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Отказ</button>
            <button type="submit" class="btn btn-info _text-white">Промени</button>
        </div>

    </form>
    </div>
    </div>
    </div>