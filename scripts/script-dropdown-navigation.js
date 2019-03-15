// JavaScript Document

var $btn = $('button');
var $nav = $('nav');
var $navUl = $('nav > ul');

$btn.click(function(){
	$navUl.toggleClass('open');	
});

// The following JS modified from 
// JS found at this per: http://codepen.io/laviperchik/pen/dlcBt
$.fn.accessibleDropDown = function () {
    
	var el = $(this);

    /* Make dropdown menus keyboard accessible */

    el.find('a').focus(function() {
        $(this).parents("li").addClass("hover");
    }).blur(function() {
        $(this).parents("li").removeClass("hover");
    });

}

$nav.accessibleDropDown();