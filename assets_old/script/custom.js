jQuery(document).ready(function($) {
   jQuery('#slider').nivoSlider();
   jQuery('#Play').hide();
   jQuery("#Pause").click(function() {
       jQuery('#Pause').fadeOut(200);
       jQuery('#Play').fadeIn(200);
       jQuery('#slider').data('nivoslider').stop();
    });
   jQuery("#Play").click(function() {
       jQuery('#Play').fadeOut(200);
       jQuery('#Pause').fadeIn(200);
       jQuery('#slider').data('nivoslider').start();
    });


   jQuery('.logo-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: 6
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });
   jQuery('.minister-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
    });
   jQuery('.project-slider').slick({
        slidesToShow:4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [{
            breakpoint:767,
            settings: {
                arrows: false,
                 slidesToShow:1,
            }
        }]
    });

   jQuery('.projectmedia-slider').slick({
        slidesToShow:3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [{
            breakpoint:767,
            settings: {
                arrows: false,
                 slidesToShow:1,
            }
        }]
    });

   jQuery('.scheme-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        fade: true,
        responsive: [{
            breakpoint: 1300,
            settings: {
                arrows: false
            }
        }]
    });

   jQuery('.gallery-slider').slick({
        slidesToShow:4,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1000,
        dots: false,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });


});
jQuery(document).ready(function() {

   jQuery('.dropdown-submenu .dropdown-toggle').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (jQuery(window).width() <= 991) {
           jQuery(this).siblings('.dropdown-menu').slideToggle(300);
        }
    });
    if (jQuery(window).width() <= 991) {
       jQuery(".dropdown-submenu .dropdown-menu").hide();
    }
   jQuery(function() {
       jQuery('#gotop').click(function(e) {
            e.preventDefault();
           jQuery("html, body").animate({ scrollTop: 0 }, 800);
            return false;
        });

    });

   jQuery("#topnav a").on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;

           jQuery('html, body').animate({
                scrollTop:jQuery(hash).offset().top
            }, 800);
        } // End if
    });



});

jQuery(window).resize(function() {
    if (jQuery(window).width() <= 991) {
       jQuery('.dropdown-submenu .dropdown-menu').hide();
    }
    if (jQuery(window).width() > 991) {
       jQuery('.dropdown-submenu .dropdown-menu').show();
    }
});
jQuery(window).on('scroll', function(event) {
    var scrollValue =jQuery(window).scrollTop();
    var offsetValue =jQuery('.logo-wrapper').outerHeight() +jQuery('.topbar').outerHeight();;
    // console.log(offsetValue);
    if (scrollValue >= offsetValue) {
       jQuery('body').addClass('affix');
    } else {
       jQuery('body').removeClass('affix');
    }
});

$(function() {
   jQuery('[data-toggle="tooltip"]').tooltip();
   jQuery(".scrolldiv").mCustomScrollbar({
        theme: "minimal-dark"
    });
});

(function($) {
    function changeFont(fontSize) {
        return function() {
           jQuery('.fontresize').css('font-size', fontSize + '%');
            sessionStorage.setItem('fSize', fontSize);
        }
    }
    var normalFont = changeFont(85),
        mediumFont = changeFont(100),
        largeFont = changeFont(115);

   jQuery('.js-font-decrease').on('click', function(e) {

        e.preventDefault();
        normalFont();
    });
   jQuery('.js-font-normal').on('click', function(e) {
        e.preventDefault();
        mediumFont();
    });
   jQuery('.js-font-increase').on('click', function(e) {
        e.preventDefault();
        largeFont();
    });
    if (sessionStorage.length !== 0) {
       jQuery('.fontresize').css('font-size', sessionStorage.getItem('fSize') + '%');
    }
})(jQuery);


function hideLoader(){
  setTimeout(function(){
    jQuery('.loader').fadeOut();                    
  }, 500);
}
    
function showLoader(){
   jQuery('.loader').show();                    
}