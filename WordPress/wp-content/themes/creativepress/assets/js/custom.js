jQuery(document).ready(function() {
	// Frontpage Slider
	jQuery('.bxslider').bxSlider({
		pager: false,
		caption: true,
		nextText: '<i class="fa fa-chevron-right"> </i>',
		prevText: '<i class="fa fa-chevron-left"> </i>'
	});

    // Widget Slider
    jQuery('.widget .blog-img-slider').bxSlider({
		auto: true,
		pager: true,
		controls: true,
		speed: 1000,
		pause: 5000,
		adaptiveHeight: true,
		minSlides: 4,
		maxSlides: 5,
		slideWidth: 205,
		slideMargin: 20
	});
	// toggle js
	jQuery('#menu-primary .menu-toggle').click(function() {
	  jQuery('#menu-primary .menu-primary-menu-container').slideToggle('slow');
	});
	// sub menu js
	jQuery('#menu-primary .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

	jQuery('#menu-primary .sub-toggle').click(function() {
		jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});
	// search js
	jQuery('.bottom-header .search-wrapper .search-icon').click(function() {
		jQuery('.search-wrapper .header-search-box').toggleClass('active');
	});

	jQuery('.bottom-header .search-wrapper .header-search-box .close').click(function() {
		jQuery('.search-wrapper .header-search-box').removeClass('active');
	});
});
