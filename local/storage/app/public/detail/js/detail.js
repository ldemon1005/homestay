$(document).ready(function(){
	var owl = $('.owl-carousel-1');
	owl.owlCarousel({
		items:4,
		loop:true,
		nav:true,
		dots:false,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true
	});

	var owl = $('.owl-carousel-5');
	owl.owlCarousel({
		items:3,
		loop:true,
		dots:false,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true
	});
});