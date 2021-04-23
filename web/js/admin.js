$('document').ready(function(){

	$('.image-del').on('click', function (e) {
		e.preventDefault();
		//alert($(this).attr('data-index'));
		url = 'dsfafd';
	        	
		$.ajax({
	        type: "POST",
	        url: $(this).attr('data-action-url'), //'/ajax/messages',
	        data: {
	            id: $(this).attr('data-id'),
	            index: $(this).attr('data-index'),
	        },
	        success: function(data){
	        	alert(url);
	        	console.log($(this));
	    		$(this).parent().parent().css('display', 'none');
	        }
	    });

	});

})



//.invitations-form__image-link>span