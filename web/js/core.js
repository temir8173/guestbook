$('document').ready(function(){

    $('body').on('submit', '.ajax-form', function(e){

		const form = $(this);

		e.preventDefault();
		e.stopPropagation();

		//setTimestamp(form.find('#messages-date'));
        $(this).find(".err_msg").remove();

		if (!form.hasClass('sending') && DefaultCheckForm(form)) {
			form.addClass('sending');
			$(form).ajaxSubmit({
				dataType: 'json',
				success: function(data){
					if (data.success !== undefined && data.message !== undefined) {
						form.removeClass('sending');
						setNotice(data.message, (data.success === true) ? 'success' : 'warning');
					}

					if (data.error !== undefined){
						if (data.message !== undefined) {
							if ( data.message === 'without_notice' )
								form.removeClass('sending');
							else if (data.message !== '')
								setNotice(data.message, (data.error === 0) ? 'success' : 'warning');
						} else {
							setNotice((data.error === 0) ? 'Отправлено' : 'Ошибка', (data.error == 0) ? 'success' : 'warning');
						}
						if (data.error === 0) {
							/* Обновляем список сообщений без перезагрузки стр-цы */
							updateMessagesBox();
							if (data.reload !== undefined){
								location.reload()
							}
							if (data.redirect !== undefined){
								setTimeout(function(){
									location.href = data.redirect;
								}, 2000);

							} if (data.callback !== undefined){
								window[data.callback](data);
							} else {
								if (!form.hasClass('notreset')) {
									form[0].reset();
								}
							}
							setTimeout(function(){
								form.removeClass('sending');
							}, 1000);
							// setTimestamp(form.find('#messages-date'));
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
	}).on('click', '.app-open-auth-modal', function (e) {
		e.preventDefault();
		const url = $(this).attr('href');
		const modal = $(this).attr('data-bs-target');
		const redirectUrl = $(this).attr('data-redirect');

		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
				$(modal).find('.modal-content').html(data);
				$(modal).attr('data-url', url);
				if (redirectUrl) {
					$(modal).attr('data-redirect', redirectUrl);
				}
			}
		});
	}).on('click', '.app-send-sms', function (e) {
		e.preventDefault();
		const url = $(this).attr('href');
		const phone = $('#loginform-phoneoremail').val();

		console.log(phone)
		$.ajax({
			type: "POST",
			data: {
				phone: phone,
			},
			url: url,
			dataType: 'json',
			success: function(data){
				console.log(data)
				setNotice(data.message, (data.success === true) ? 'success' : 'warning');
			}
		});
	});

	$('.auth-modal').on('submit', '.async-form', function(e) {
		const form = $(this);
		const redirect = form.closest('.auth-modal').data('redirect')
		const modal = $('#auth-modal');
		const url = modal.attr('data-url');
		const formData = form.serializeArray();

		const formattedData = {};
		formData.forEach(item => {
			formattedData[item.name] = item.value;
		});

		e.preventDefault();
		e.stopPropagation();

		if (!form.hasClass('sending') && DefaultCheckForm(form)) {
			form.addClass('sending');
			$(form).ajaxSubmit({
				dataType: 'json',
				success: function(data){
					if (data.success !== undefined && data.message !== undefined) {
						form.removeClass('sending');
						setNotice(data.message, (data.success === true) ? 'success' : 'warning');

						if (data.success !== true) {
							formattedData.only_render = 1;
							$.ajax({
								type: "POST",
								data: formattedData,
								url: url,
								success: function(data){
									$(modal).find('.modal-content').html(data);
								}
							});
						}

						if (data.success) {
							if (redirect !== undefined) {
								setTimeout(function(){
									location.href = redirect;
								}, 2000);
							} else {
								setTimeout(function(){
									location.reload();
								}, 1500);
							}
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
		}
	});

	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}

	$('.copy-button').click(function() {
		let textToCopy = $(this).closest('td').find('.invitation-link').text();
		let tempTextarea = $('<textarea>');
		const message = $(this).data('message');
		$('body').append(tempTextarea);
		tempTextarea.val(textToCopy).select();
		document.execCommand('copy');
		tempTextarea.remove();
		setNotice(message, 'success');
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

	const deadline = $('#countdown').attr('data-event-date'); //"June 19 2021 19:00:00 GMT+0500"; //new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000); // for endless timer
    if ( deadline ) {
    	initializeClock('countdown', deadline);
	}

	const playButton = $('.play-button');
	const stopButton = $('.stop-button');
	const audioSrc = $('.audio').data('audio-src');

	const audio = new Audio();

	playButton.on('click', function () {
		$(this).hide();
		stopButton.show();
		audio.src = audioSrc;
		audio.volume = 1.0;
		audio.play();
	})

	stopButton.on('click', function () {
		$(this).hide();
		playButton.show();
		audio.pause();
	})

	audio.addEventListener("ended", function() {
		stopButton.hide();
		playButton.show();
		audio.pause();
	});

	$('.app-audio-dropdown').on('change', function () {
		const player = $('#app-audio-dropdown-player');
		const pathPre = player.data('path-pre')
		player[0].load();
		player[0].play()
		$('#app-audio-dropdown-player source').attr('src', pathPre + $(this).val());
	})
})

function DefaultCheckForm(from) {
	let check = true;
	from.find('input.required, textarea.required, select.required').each(function(){
		if(!DefualtCheckfield($(this))){
			check = false;
		}
		$(this).change(function(){
			DefualtCheckfield($(this));
		})
	})
	from.find('input.checked, textarea.checked, select.checked').each(function(){
		if($(this).val() !== '' && !DefualtCheckfield($(this))){
			check = false;
		}
		$(this).change(function(){
			DefualtCheckfield($(this));
		})
	})
	from.find('div.chosen-check').each(function(){
		let check_group = false;
		let options_group = $(this);
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
	}  else if (el.hasClass('int') &&  ( el.val() === '' || parseInt(el.val()) <= 0) ) {
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
	const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function ValidURL(str) {
	return str.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function setNotice(mess, theme, delay, position) {

	if (delay === undefined) {
		delay = 6000;
	}
	if (position === undefined) {
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
		delay: delay,
		allowDismiss: true,
		spacing: 10
	}

	if ($.simplyToast !== undefined) {
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
