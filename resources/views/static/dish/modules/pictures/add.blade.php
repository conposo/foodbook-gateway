
    <label class="pl-1" for="picture_main"><small>Избери основна снимка</small></label>

    <div id="picture_main" class="mb-2 custom-file">
        <input type="file" class="_d-none custom-file-input" id="picture_main" name="picture_main">
        <label class="custom-file-label" for="picture">Основна снимка</label>
    </div>


    <label class="pl-1 w-100 d-flex justify-content-start"
            data-toggle="collapse" data-target="#collapseFileInputs" aria-expanded="true" aria-controls="collapseFileInputs"
        style="cursor: pointer;">
        <small>Избери още снимки</small>
        <i class="ml-2 fas fa-caret-down" style="margin-top: 1px;"></i>
        <!-- <i class="ml-2 fas fa-sort-down"></i> -->
    </label>

    <div id="collapseFileInputs" class="collapse">
        <div id="picture1" class="mb-2 custom-file">
            <input type="file" class="_d-none custom-file-input" id="picture1" name="picture1">
            <label class="custom-file-label" for="picture">Снимка 1</label>
        </div>

        <div id="picture2" class="mb-2 custom-file">
            <input type="file" class="_d-none custom-file-input" id="picture2" name="picture2">
            <label class="custom-file-label" for="picture">Снимка 2</label>
        </div>

        <div id="picture3" class="mb-2 custom-file">
            <input type="file" class="_d-none custom-file-input" id="picture3" name="picture3">
            <label class="custom-file-label" for="picture">Снимка 3</label>
        </div>

        <div id="picture4" class="mb-2 custom-file">
            <input type="file" class="_d-none custom-file-input" id="picture4" name="picture4">
            <label class="custom-file-label" for="picture">Снимка 4</label>
        </div>
    </div>

    <style>
    label.custom-file-label::after {
        content: 'Избери' !important;
    }
    </style>

    <script>
    $('#picture1, #picture2, #picture3, #picture4').change(function() {
        console.log(5)
        var val = $(this).val();

        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'gif': case 'jpg': case 'png': case 'jpeg':
                $('#'+$(this).attr('id')+'+label').html( val.split('\\')[2] );
                // console.log(val.split('\\')[2]);
                break;
            default:
                $(this).val('');
                // alert("Файлът, който се опитвате да качите не е изображение! Моля изберете изображение.");
                break;
        }
    });
    </script>