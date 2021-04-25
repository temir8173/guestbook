$('document').ready(function(){


    $('body').on('submit', '.ajax-form', function(e){
    	
		var form = $(this);

		e.preventDefault();
		e.stopPropagation();

		//setTimestamp(form.find('#messages-date'));
        $(this).find(".err_msg").remove();

		if (!form.hasClass('sending') && DefaultCheckForm(form)) {
			form.addClass('sending');
			$(form).ajaxSubmit({
				dataType: 'json',
				success: function(data){

					if (data.error != undefined){

						if (data.message != undefined) {
							if ( data.message == 'without_notice' )
								form.removeClass('sending');
							else if (data.message != '')
								setNotice(data.message, (data.error == 0) ? 'success' : 'warning');
						} else {
							setNotice((data.error == 0) ? 'Отправлено' : 'Ошибка', (data.error == 0) ? 'success' : 'warning');
						}
						if (data.error == 0) {
							/* Обновляем список сообщений без перезагрузки стр-цы */
							updateMessagesBox();
							if (data.reload != undefined){
								location.reload()
							}	
							if (data.redirect != undefined){
								setTimeout(function(){
									location.href = data.redirect;
								}, 2000);
								
							} if (data.callback != undefined){
								window[data.callback](data);
							} else {
								if (!form.hasClass('notreset')) {
									form[0].reset();
								}
							}
							setTimeout(function(){
								form.removeClass('sending');
								
							}, 1000);
							//setTimestamp(form.find('#messages-date'));
						}
					}

				},
				complete: function(response){
					
					setTimeout(function(){
						form.removeClass('sending');
						
					}, 1000);

				},
				error: function(requestObject, error, errorThrown){
					
					setNotice('Системная ошибка', 'warning');
				}
			})
		} else {

			form.find(".error").each(function( index ) {
				$(this).after("<span class='err_msg'>" + $(this).attr('data-error-msg') + "</span>");
			});

            
        }
	});

    $('a.scrollto').on('click', function() {

        let href = $(this).attr('href'),
            header_h = (($('#wpadminbar.nojq').length) ? $('#wpadminbar.nojq').height() : 0),
            header_navbar = 0,
            scrollTop = $(href).offset().top - header_h - header_navbar;

        $('html, body').animate({
            scrollTop: scrollTop
        }, {
            duration: (scrollTop<2000) ? 650 : 650,   // по умолчанию «400» 
            easing: "swing" // по умолчанию «swing» 
        });

        return false;
    });

    baguetteBox.run('.restaurant-pic');

    if ( $('.notif__items')[0] ) {
    	$('.notif__items').scrollTop($('.notif__items')[0].scrollHeight);
	}

    var deadline = $('#countdown').attr('data-event-date'); //"June 19 2021 19:00:00 GMT+0500"; //new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000); // for endless timer
    if ( deadline ) {
    	initializeClock('countdown', deadline);
	}

})

function DefaultCheckForm(from) {
	var check = true;
	from.find('input.required, textarea.required, select.required').each(function(){
		if(!DefualtCheckfield($(this))){
			check = false;
		}
		$(this).change(function(){
			DefualtCheckfield($(this));
		})
	})
	from.find('input.checked, textarea.checked, select.checked').each(function(){
		if($(this).val() != '' && !DefualtCheckfield($(this))){
			check = false;
		}
		$(this).change(function(){
			DefualtCheckfield($(this));
		})
	})
	from.find('div.chosen-check').each(function(){
		check_group = false;
		options_group = $(this);
		options_group.find('input').each(function(){
			if ( $(this).is(':checked') || $(this).hasClass('input-percentage')){
				check_group = true;
			}
		})

		if(check_group) {
			$(this).removeClass('error');
			return true;
		} else {
			$(this).addClass('error');
			check = false;
		}
		
	})
	return check;
}
 
function DefualtCheckfield(el) {

	if ((el.hasClass('name') || el.hasClass('text')) && el.val().length < 1 ){
		el.addClass('error');
		return false;
	}  else if (el.hasClass('email') && !IsEmail(el.val())) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('id') &&  parseInt(el.val()) <= 0) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('int') &&  ( el.val() == '' || parseInt(el.val()) <= 0) ) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('password') &&  el.val().replace(/â€¢/g, '').length <= 4) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('link') &&  !ValidURL(el.val()) && !ValidURL('http://'+el.val()) ) {
		el.addClass('error');
		return false;
	} else {
		el.removeClass('error');
		return true;
	}
}

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function ValidURL(str) {
	return str.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function setNotice(mess, theme, delay, position) {

	if (delay == undefined) {
		delay = 6000;
	}
	if (position == undefined) {
		position = 'top';
	}

	var options = {
		appendTo: "body",
		customClass: 'cstm_notice',
		type: "info",
		offset:
		{
		   from: position,
		   amount: 30
		},
		align: "right",
		minWidth: 250,
		maxWidth: 400,
		delay: delay,
		allowDismiss: true,
		spacing: 10
	}

	if ($.simplyToast != undefined) {
		$.simplyToast(mess, theme, options);
	} else {
		alert(mess);
	}
}

function updateMessagesBox() {
	$.ajax({
        type: "POST",
        url: $('#messages-box').attr('data-action-url'), //'/ajax/messages',
        data: {
            order: 'DESC',
        },
        success: function(data){
            $('#messages-box').html(data);
    		$('.notif__items').scrollTop($('.notif__items')[0].scrollHeight);
        }
    });
}

function setTimestamp(el) {
	const currentDate = new Date();
	const timestamp = currentDate.getTime();
	el.attr('value', Math.floor(timestamp / 1000));
}

