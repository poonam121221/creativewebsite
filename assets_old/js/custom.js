$(document).ready(function () {
	//$('#header').load("nav.html");
	//$('#footer').load("footer.html");
});



$('.main-slider').slick({
	arrows: true,
	infinite: true,
	animation: true,
	dots: true,
	autoplay: true,
	autoplayspeed: 8000,
	speed: 800,
	pauseOnHover: false,
	pauseOnFocus: false,
	fade: true,
	cssEase: 'linear',
	responsive: [{
		breakpoint: 767,
		settings: {
			dots: false,
		}
	}
]
});

$('.slider-playback').on('click', function (e) {
	e.preventDefault();
	self = $(this);
	if (self.hasClass('play')) {
		self.removeClass('play').addClass('pause');
		$('.main-slider').slick("slickPause");
		self.find(".fa").removeClass("fa-pause").addClass("fa-play");
		console.log('Paused slideshow.');

	} else if (self.hasClass('pause')) {
		self.removeClass('pause').addClass('play');
		$('.main-slider').slick("slickPlay");
		self.find(".fa").removeClass("fa-play").addClass("fa-pause");
		console.log('Resuming slideshow.');
	}
});

/*$('.newsticker').newsTicker({
	row_height: 18,
	max_rows: 1,
	speed: 600,
	direction: 'up',
	duration: 2000,
	autostart: 1,
	pauseOnHover: 0,
	prevButton: $('#prev-button'),
	nextButton: $('#next-button'),
	stopButton: $('#stop-button'),
	startButton: $('#start-button')
});*/

$('.news-arrow .fa').click(function () {
	$('#stop-button').removeClass('bg-danger');
});
$('#stop-button').click(function () {
	$(this).toggleClass('bg-danger');
});

$('.gallery-slider').slick({
	slidesToShow: 4,
	arrows: true,
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
$('.logo-slider').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	dots: false,
	arrows: true,
	autoplay: true,
	autoplaySpeed: 2000,
	speed: 1000,
	responsive: [{
			breakpoint: 1600,
			settings: {
				slidesToShow: 5
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
$('.link-slider').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	dots: false,
	arrows: true,
	autoplay: true,
	autoplaySpeed: 2000,
	speed: 1500,
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
// div floating 
$(window).on('scroll', function (event) {
	var scrollValue = $(window).scrollTop();
	var offsetValue = $('.logo-wrapper').outerHeight() + 35;
	if (scrollValue >= offsetValue) {
		$('body').addClass('affix');
	} else {
		$('body').removeClass('affix');
	}
});

$(document).ready(function () {
	if ($(window).width() < 768) {
		$('.dropdown-submenu .dropdown-toggle').click(function (e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).siblings('.dropdown-menu').slideToggle(300);
		});
	}
});
$(document).ready(function () {
	$(window).resize(function () {
		$('.eventlist2').css('width', $('.t-head').outerWidth());
	}).resize();
});

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});
$(".eventlist, .eventlist2").mCustomScrollbar({
	theme: "minimal-dark"
});

$(function () {
	$('#gotop').click(function (e) {
		e.preventDefault();
		$("html, body").animate({
			scrollTop: 0
		}, 800);
		return false;
	});

});

//new WOW().init();

(function ($) {
	$(document).ready(function () {
		$('#subsToggle').click(function (e) {
			$('.subscribe').toggleClass("open");
			setTimeout(function () {
				console.log("timeout set");
			}, 200);
			e.preventDefault();
		});
	});
})(jQuery);

$(document).ready(function () {
	setTimeout (function(){
		$('.loader').fadeOut();
	}, 1000);
	
	$("#topnav a").on('click', function(event) {
		if (this.hash !== "") {
		  event.preventDefault();
		  var hash = this.hash;
	
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800);
		} // End if
	  });

	(function ($) {
		function changeFont(fontSize) {
			return function () {
				$('.fontresize').css('font-size', fontSize + '%');
				sessionStorage.setItem('fSize', fontSize);
			}
		}
		var normalFont = changeFont(85),
			mediumFont = changeFont(100),
			largeFont = changeFont(115);

		$('.js-font-decrease').on('click', function (e) {
                    
			e.preventDefault();
			normalFont();
		});
		$('.js-font-normal').on('click', function (e) {
			e.preventDefault();
			mediumFont();
		});
		$('.js-font-increase').on('click', function (e) {
			e.preventDefault();
			largeFont();
		});
		if (sessionStorage.length !== 0) {
			$('fontresize').css('font-size', sessionStorage.getItem('fSize') + '%');
		}
	})(jQuery);

	

});

function hideLoader(){
  setTimeout(function(){
	 $('.loader').fadeOut();					
  }, 500);
}
	
function showLoader(){
	$('.loader').show();					
}



$(".article").slick({
        dots: false,
        infinite: true,
        centerMode: false,
        slidesToShow:4,
        slidesToScroll: 1,
    autoplay: false,
      autoplaySpeed: 3000,
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
      });
	  
$(".guidingforce").slick({
        dots: false,
        infinite: true,
        centerMode: false,
        slidesToShow:2,
        slidesToScroll: 1,
		autoplay: true,
  		autoplaySpeed: 3000,
		  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
      });