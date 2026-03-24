$(".toggle-nav").click(function () {
  $(".nav-menu").css("left", "0px");
});
$(".mobile-back").click(function () {
  $(".nav-menu").css("left", "-410px");
});

$(".page-wrapper").attr(
  "class",
  "page-wrapper " + localStorage.getItem("page-wrapper")
);
$(".page-body-wrapper").attr(
  "class",
  "page-body-wrapper " + localStorage.getItem("page-body-wrapper")
);

if (localStorage.getItem("page-wrapper") === null) {
  $(".page-wrapper").addClass("compact-wrapper");
}

// left sidebar and horizotal menu
if ($("#pageWrapper").hasClass("compact-wrapper")) {
  jQuery(".submenu-title").append(
    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
  );
  jQuery(".submenu-title").click(function () {
    jQuery(".submenu-title").removeClass("active");
    jQuery(".submenu-title")
      .find("div")
      .replaceWith(
        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
      );
    jQuery(".submenu-content").slideUp("normal");
    if (jQuery(this).next().is(":hidden") == true) {
      jQuery(this).addClass("active");
      jQuery(this)
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
        );
      jQuery(this).next().slideDown("normal");
    } else {
      jQuery(this)
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
    }
  });
  jQuery(".submenu-content").hide();

  jQuery(".menu-title").append(
    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
  );
  jQuery(".menu-title").click(function () {
    jQuery(".menu-title").removeClass("active");
    jQuery(".menu-title")
      .find("div")
      .replaceWith(
        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
      );
    jQuery(".menu-content").slideUp("normal");
    if (jQuery(this).next().is(":hidden") == true) {
      jQuery(this).addClass("active");
      jQuery(this)
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
        );
      jQuery(this).next().slideDown("normal");
    } else {
      jQuery(this)
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
    }
  });
  jQuery(".menu-content").hide();
} else if ($("#pageWrapper").hasClass("horizontal-wrapper")) {
  var contentwidth = jQuery(window).width();
  if (contentwidth < "992") {
    $("#pageWrapper")
      .removeClass("horizontal-wrapper")
      .addClass("compact-wrapper");
    $(".page-body-wrapper")
      .removeClass("horizontal-menu")
      .addClass("sidebar-icon");
    jQuery(".submenu-title").append(
      '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
    );
    jQuery(".submenu-title").click(function () {
      jQuery(".submenu-title").removeClass("active");
      jQuery(".submenu-title")
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
      jQuery(".submenu-content").slideUp("normal");
      if (jQuery(this).next().is(":hidden") == true) {
        jQuery(this).addClass("active");
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
          );
        jQuery(this).next().slideDown("normal");
      } else {
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
          );
      }
    });
    jQuery(".submenu-content").hide();

    jQuery(".menu-title").append(
      '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
    );
    jQuery(".menu-title").click(function () {
      jQuery(".menu-title").removeClass("active");
      jQuery(".menu-title")
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
      jQuery(".menu-content").slideUp("normal");
      if (jQuery(this).next().is(":hidden") == true) {
        jQuery(this).addClass("active");
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
          );
        jQuery(this).next().slideDown("normal");
      } else {
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
          );
      }
    });
    jQuery(".menu-content").hide();
  }
}

// toggle sidebar

$(".toggle-sidebar").click(function () {
  $(".main-nav").toggleClass("close_icon");
  $(".page-main-header").toggleClass("close_icon");
});

//responsive sidebar
var $window = $(window);
var widthwindow = $window.width();
(function ($) {
  "use strict";
  if (widthwindow + 17 <= 993) {
    $(".toggle-sidebar").attr("checked", false);
    $(".main-nav").addClass("close_icon");
    $(".page-main-header").addClass("close_icon");
  }
})(jQuery);

$(window).resize(function () {
  var widthwindaw = $window.width();

  if (widthwindaw + 17 <= 991) {
    $(".toggle-sidebar").attr("checked", false);
    $(".main-nav").addClass("close_icon");
    $(".page-main-header").addClass("close_icon");
  } else {
    $(".toggle-sidebar").attr("checked", false);
    $(".main-nav").removeClass("close_icon");
    $(".page-main-header").removeClass("close_icon");
  }

  if (widthwindow >= 768) {
    $(".toggle-sidebar").click(function () {
      $(".main-nav").toggleClass("close_icon");
      $(".page-main-header").toggleClass("close_icon");
    });
  }
});

// horizontal arrowss
var view = $("#mainnav");
var move = "500px";
var leftsideLimit = -500;

// get wrapper width
var getMenuWrapperSize = function () {
  return $(".sidebar-wrapper").innerWidth();
};
var menuWrapperSize = getMenuWrapperSize();

if (menuWrapperSize >= "1660") {
  var sliderLimit = -3000;
} else if (menuWrapperSize >= "1440") {
  var sliderLimit = -3600;
} else {
  var sliderLimit = -4200;
}

$("#left-arrow").addClass("disabled");
$("#right-arrow").click(function () {
  var currentPosition = parseInt(view.css("marginLeft"));
  if (currentPosition >= sliderLimit) {
    $("#left-arrow").removeClass("disabled");
    view.stop(false, true).animate(
      {
        marginLeft: "-=" + move,
      },
      {
        duration: 400,
      }
    );
    if (currentPosition == sliderLimit) {
      $(this).addClass("disabled");
      console.log("sliderLimit", sliderLimit);
    }
  }
});

$("#left-arrow").click(function () {
  var currentPosition = parseInt(view.css("marginLeft"));
  if (currentPosition < 0) {
    view.stop(false, true).animate(
      {
        marginLeft: "+=" + move,
      },
      {
        duration: 400,
      }
    );
    $("#right-arrow").removeClass("disabled");
    $("#left-arrow").removeClass("disabled");
    if (currentPosition >= leftsideLimit) {
      $(this).addClass("disabled");
    }
  }
});

// Retain active class and only remove from non-matching links
$(".main-navbar").find("a").not(".active, [href='" + window.location.pathname + "']").removeClass("active");
$(".main-navbar").find("li").not(".active").removeClass("active");

// Handle active state for current link
// var current = window.location.pathname;
// var flag = false;
// $(".main-navbar ul>li a").each(function () {
//   var link = $(this).attr("href");
//   if (link && current.indexOf(link) !== -1) {
//     $(this).addClass("active")
//       .parents("li")
//       .children("a")
//       .addClass("active");
    
//     $(this).parents("ul").css("display", "block");

//     $(this).closest("li").parents("li").find("> a div").replaceWith(
//       '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
//     );
//     flag = true;
//     return false; // Stop after finding the first match
//   }
// });

// Scroll to active link if found
var $activeLink = $("a.nav-link.menu-title.active");
if ($activeLink.length) {
  $(".custom-scrollbar").animate({
    scrollTop: $activeLink.offset().top - 500
  }, 1000);
}
// if(flag == false){

//   $(".main-navbar li > a.active").each(function () {
//     // Find the nearest submenu (e.g., <ul>) under the active link's parent <li>
//     var $submenu = $(this).siblings(".nav-submenu, .menu-content");
  
//     if ($submenu.length) {
//       // If the submenu exists, toggle its visibility
//       $submenu.slideToggle(300);
  
//       // Optionally add or remove a class for the dropdown indicator
//       $(this).find(".according-menu i").toggleClass("fa-angle-down fa-angle-up");
//     }
//   });
// }
