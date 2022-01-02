
<label class="m-0 pl-1" for="picture_main"><small>Избери основна снимка</small></label>
<div id="picture_main" class="mb-2 custom-file">
    <input type="file" id="picture_main" class="custom-file-input" name="picture_main">
    <label class="custom-file-label" for="picture">Основна снимка</label>
</div>
<div class="picture_main d-flex pictures"></div>


<label class="mt-2 pl-1 w-100 d-flex justify-content-start"
    data-toggle="collapse" data-target="#collapseFileInputs" aria-expanded="true" aria-controls="collapseFileInputs"
    style="cursor: pointer;">
    <small>Избери още снимки</small>
    <i class="ml-2 fas fa-caret-down" style="margin-top: 1px;"></i>
</label>

<div id="collapseFileInputs" class="collapse">
    <div id="picture1" class="mb-2 custom-file">
        <input type="file" class="pictures_other custom-file-input" id="picture1" name="pictures[]">
        <label class="custom-file-label" for="picture">Снимка 1</label>
    </div>

    <div id="picture2" class="mb-2 custom-file">
        <input type="file" class="pictures_other custom-file-input" id="picture2" name="pictures[]">
        <label class="custom-file-label" for="picture">Снимка 2</label>
    </div>

    <div id="picture3" class="mb-2 custom-file">
        <input type="file" class="pictures_other custom-file-input" id="picture3" name="pictures[]">
        <label class="custom-file-label" for="picture">Снимка 3</label>
    </div>

    <div id="picture4" class="mb-2 custom-file">
        <input type="file" class="pictures_other custom-file-input" id="picture4" name="pictures[]">
        <label class="custom-file-label" for="picture">Снимка 4</label>
    </div>
</div>

<div class="picture_other d-flex-column pictures" style="
    _border: 1px solid silver;
"></div>

<script>
	var storedFiles = [];
	
	$(document).ready(function() {
		$('#picture_main').on('change', {'target_selector':'picture_main'}, handleFileSelect);
		$('.pictures_other').on('change', {'target_selector':'picture_other'}, handleFileSelect);		
		$('body').on('click', '.removeFile', removeFile);
	});
		
	function handleFileSelect(e) {
        target_selector = e.data.target_selector;

		var files = e.target.files;
		var filesArr = Array.prototype.slice.call(files);
		filesArr.forEach(function(f) {			

			if(!f.type.match("image.*")) {
				return;
			}
			storedFiles.push(f);

			var reader = new FileReader();
			reader.onload = function (e) {
				var html = `<div class="w-100 mb-1 align-items-center"><img src="${e.target.result}" data-file="${f.name}" class="removeFile" title="Click to remove"></div>`;
				$('.'+target_selector).append(html);
			}
			reader.readAsDataURL(f); 
		});
		
	}

	function handleForm(e) {
		e.preventDefault();
		var data = new FormData();
		
		for(var i=0, len=storedFiles.length; i<len; i++) {
			data.append('files', storedFiles[i]);	
		}
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'handler.cfm', true);
		
		xhr.onload = function(e) {
			if(this.status == 200) {
				console.log(e.currentTarget.responseText);	
				alert(e.currentTarget.responseText + ' items uploaded.');
			}
		}

		xhr.send(data);
	}

	function removeFile(e) {
		var file = $(this).data("file");
		for(var i=0;i<storedFiles.length;i++) {
			if(storedFiles[i].name === file) {
				storedFiles.splice(i,1);
				break;
			}
		}
		$(this).parent().remove();
	}
</script>

<style>
	.pictures div {
        /* flex-basis: 50%; */
    }
    img.removeFile {
		width: 100%;
		/* max-height: 200px; */
		/* margin-bottom:10px; */
	}
label.custom-file-label::after {
    content: 'Отвори' !important;
}
</style>