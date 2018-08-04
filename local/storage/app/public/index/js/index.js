$(document).ready(function(){
	var owl = $('.owl-carousel-1');
	owl.owlCarousel({
		items:3,
		loop:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true
	});

	var owl = $('.owl-carousel-5');
	owl.owlCarousel({
		items:3,
		loop:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true
	});

	var owl = $('.owl-carousel-4');
	owl.owlCarousel({
		items:6,
		loop:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true
	});

	$('.owl-carousel-5 .slide-item').hover(function(){
		$(this).find('.hs-btn').toggleClass('hs-btn-green');
	});

	$('.input-daterange').datepicker({
		format: "dd/mm/yyyy",
		todayHighlight: true
	});

	var owl_partner = $('.partner-carousel');
	owl_partner.owlCarousel({
		items:5,
		loop:true,
		margin:100,
		autoplay:true,
		autoplayHoverPause:true,
		slideTransition: 'linear',
		autoplayTimeout: 5000,
		autoplaySpeed: 6000
	})

	owl_partner.trigger('play.owl.autoplay');
});