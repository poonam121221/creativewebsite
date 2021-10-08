$(window).load(function () {
  $("#slider").nivoSlider();
  $("#Play").hide();
  $("#Pause").click(function () {
    $("#Pause").fadeOut(200);
    $("#Play").fadeIn(200);
    $("#slider").data("nivoslider").stop();
  });
  $("#Play").click(function () {
    $("#Play").fadeOut(200);
    $("#Pause").fadeIn(200);
    $("#slider").data("nivoslider").start();
  });
});

$("#our-partner").owlCarousel({
  loop: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: false,
	    loop: true,
    },
    600: {
      items: 3,
      nav: false,
	    loop: true,
    },
    1000: {
      items: 5,
      nav: false,
       loop: true,
	  
    },
    1600: {
      items: 6,
      nav: false,
       loop: true,
    },
  },
});

$("#cm-min").owlCarousel({
  loop: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: false,
    },
    600: {
      items: 1,
      nav: false,
    },
    1000: {
      items: 1,
      nav: false,
    },
    1600: {
      items: 1,
      nav: false,
    },
  },
});

$(".marquee").marquee({
  //speed in milliseconds of the marquee
  duration: 9000,
  //gap in pixels between the tickers
  gap: 10,
  //time in milliseconds before the marquee will start animating
  delayBeforeStart: 0,
  pauseOnHover: 5,
  //'left' or 'right'
  direction: "up",
  //true or false - should the marquee be duplicated to show an effect of continues flow
  duplicated: true,
});
//# sourceURL=pen.js

$(".marquee1").marquee({
  //speed in milliseconds of the marquee
  duration: 14000,
  //gap in pixels between the tickers
  gap: 10,
  //time in milliseconds before the marquee will start animating
  delayBeforeStart: 0,
  pauseOnHover: 5,
  //'left' or 'right'
  direction: "up",
  //true or false - should the marquee be duplicated to show an effect of continues flow
  duplicated: true,
});
//# sourceURL=pen.js

$(".marquee2").marquee({
  //speed in milliseconds of the marquee
  duration: 18000,
  //gap in pixels between the tickers
  gap: 10,
  //time in milliseconds before the marquee will start animating
  delayBeforeStart: 0,
  pauseOnHover: 5,
  //'left' or 'right'
  direction: "up",
  //true or false - should the marquee be duplicated to show an effect of continues flow
  duplicated: true,
});
//# sourceURL=pen.js

$(".marquee3").marquee({
  //speed in milliseconds of the marquee
  duration: 20000,
  //gap in pixels between the tickers
  gap: 10,
  //time in milliseconds before the marquee will start animating
  delayBeforeStart: 0,
  pauseOnHover: 5,
  //'left' or 'right'
  direction: "up",
  //true or false - should the marquee be duplicated to show an effect of continues flow
  duplicated: true,
});
//# sourceURL=pen.js







$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $("#scroll").fadeIn();
    } else {
      $("#scroll").fadeOut();
    }
  });
  $("#scroll").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
});
new WOW().init();

(function ($) {
  $(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
    if (!$(this).next().hasClass("show")) {
      $(this)
        .parents(".dropdown-menu")
        .first()
        .find(".show")
        .removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass("show");

    $(this)
      .parents("li.nav-item.dropdown.show")
      .on("hidden.bs.dropdown", function (e) {
        $(".dropdown-submenu .show").removeClass("show");
      });

    return false;
  });
})(jQuery);
