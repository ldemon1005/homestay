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

function add_order(id,price) {
	var html_id = "<input class='d-none' name=\"book[id_room]\" value=\""+id+"\">";
	var html_price = "<input class='d-none' name=\"book[price]\" value=\""+price+"\">";
    $('#bedroom-check').append(html_id);
    $('#bedroom-check').append(html_price);
	$('#bedroom-check').submit();
}