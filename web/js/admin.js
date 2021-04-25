$('document').ready(function(){

	$('.image-del').on('click', function (e) {
		
		e.preventDefault();

		if (confirm('Вы действительно хотите удалить это изображение?')) {
			$.ajax({
		        type: "POST",
		        url: $(this).attr('data-action-url'), //'/ajax/messages',
		        data: {
		            id: $(this).attr('data-id'),
		            index: $(this).attr('data-index'),
		        },
		        success: function(data){
					//$(this).parent().parent().css('display', 'none');
		        }
		    });
			
			$(this).parent().parent().css('display', 'none');
		}
	        	
		

	});

	/* drop upload images */

	var dropZone = $('.upload-container');
	var inputDrop = dropZone.find('input[type=file]');

	inputDrop.focus(function() {
		$('label').addClass('focus');
	})
	.focusout(function() {
		$('label').removeClass('focus');
	});


	dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(){
		return false;
	});

	dropZone.on('dragover dragenter', function() {
		$(this).addClass('dragover');
	});

	dropZone.on('dragleave', function(e) {
		let dx = e.pageX - $(this).offset().left;
		let dy = e.pageY - $(this).offset().top;
		if ((dx < 0) || (dx > $(this).width()) || (dy < 0) || (dy > $(this).height())) {
			$(this).removeClass('dragover');
		}
	});

	dropZone.on('drop', function(e) {
		$(this).removeClass('dragover');
		let files = e.originalEvent.dataTransfer.files;
		$(this).find('input[type=file]')[0].files = files;
		var preview = $(this).parent().find('.preview');
		getPreview(preview, files);
		//sendFiles(files);
	});

	inputDrop.change(function() {
		let files = this.files;
		var preview = $(this).parents('.invitations-form__section').find('.preview');
		getPreview(preview, files);
		//sendFiles(files);
	});

	var fileTypes = [
		'image/jpeg',
		'image/jpg',
		'image/png',
		'image/gif',
	]

	function validFileType(file) {
		for(var i = 0; i < fileTypes.length; i++) {
			if(file.type === fileTypes[i]) {
				return true;
			}
		}

		return false;
	}

	function returnFileSize(number) {
		if(number < 1024) {
			return number + 'bytes';
		} else if(number > 1024 && number < 1048576) {
			return (number/1024).toFixed(1) + 'KB';
		} else if(number > 1048576) {
			return (number/1048576).toFixed(1) + 'MB';
		}
	}

	function getPreview(preview, curFiles) {
		while(preview.firstChild) {
			preview.removeChild(preview.firstChild);
		}

		//var curFiles = input.files;
		if(curFiles.length === 0) {
			var para = document.createElement('p');
			para.textContent = 'Файлдар таңдалмаған';
			preview.html(para);
		} else {
			var list = document.createElement('div');
			list.className = "row";
			preview.html(list);
			for(var i = 0; i < curFiles.length; i++) {
				var listItem = document.createElement('div');
				listItem.className = "col-sm-2";
				var para = document.createElement('p');
				para.style.fontSize = '11px';
				if(validFileType(curFiles[i])) {
					para.textContent = 'Файл аты ' + curFiles[i].name + ', өлшемі ' + returnFileSize(curFiles[i].size) + '.';
					var image = document.createElement('img');
					image.src = window.URL.createObjectURL(curFiles[i]);

					listItem.append(image);
					listItem.append(para);

				} else {
					para.textContent = 'File name ' + curFiles[i].name + ': Файлдың түрі дұрыс емес. Қайтадан таңдаңыз.';
					listItem.append(para);
				}

				list.append(listItem);
			}
		}
	}
	function sendFiles(files) {
		let maxFileSize = 5242880;
		let Data = new FormData();
		$(files).each(function(index, file) {
			if ((file.size <= maxFileSize) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
				Data.append('images[]', file);
			};
		});
		$.ajax({
			url: dropZone.attr('data-action'),
			type: 'POST',
			data: Data,
			contentType: false,
			processData: false,
			success: function(data) {
				console.log(data);
				alert ('Файлы были успешно загружены!');
			}
		});
	}

})



//.invitations-form__image-link>span