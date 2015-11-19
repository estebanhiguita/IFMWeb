//Dominio a configurar de gestion system
var url = document.location.href;
url = url.toLowerCase();

var dominioGS = "gestionsystem.com.co";

if (url.indexOf(".com.co") >= 0)
{
	dominioGS = "gestionsystem.com.co";
}else {
	dominioGS = "gestionsystem.com";
}

//VerificaciÃ³n de url para la consulta de datos
//a la direcciÃ³n correcta del dominio

var urlImages = "";
var urlAPI = "";

if (url.indexOf("www") >= 0)
{
	urlImages = "http://www." + dominioGS + "/GSYSTEM/Admin/dist/upload/";
	urlAPI = "http://www." + dominioGS + "/GSYSTEM/api/";


}else{
	urlImages = "http://" + dominioGS + "/GSYSTEM/Admin/dist/upload/";
	urlAPI = "http://" + dominioGS + "/GSYSTEM/api/";
}



jQuery(function($) {'use strict',


	//#main-slider
	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 8000
		});
	});


	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
			$(this).find('>.panel-heading').removeClass('active');
		});

		$(this).closest('.panel-heading').toggleClass('active');
	});

	//Initiat WOW JS
	new WOW().init();


	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),

			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">' + data.message + '</p>').delay(3000).fadeOut();
		});
	});


	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});


});
