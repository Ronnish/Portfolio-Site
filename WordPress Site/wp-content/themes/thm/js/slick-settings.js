jQuery(document).ready(function($){
            $('.slider').slick({
                dots: true,
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 6000, // speed is in milliseconds
                speed: 300,
                responsive: [{
                   breakpoint: 768,
                   settings: {
                   slidesToShow: 1,
                   slidesToScroll: 1,
                   }
                 },{
                   breakpoint: 600,
                   settings: "unslick"
                 }]
            });
         });
