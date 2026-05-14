$(function () {
  "use strict";
  $("#global-loader").fadeOut("slow");
  if (window.matchMedia("(min-width: 992px)").matches) {
    $(".main-navbar .active").removeClass("show");
    $(".main-header-menu .active").removeClass("show");
  }
  $(".main-header .dropdown > a").on("click", function (e) {
    e.preventDefault();
    $(this).parent().toggleClass("show");
    $(this).parent().siblings().removeClass("show");
    $(this).find(".drop-flag").removeClass("show");
  });
  $(document).on("click", ".fullscreen-button", function toggleFullScreen() {
    $("html").addClass("fullscreen-button");
    if (
      (document.fullScreenElement !== undefined &&
        document.fullScreenElement === null) ||
      (document.msFullscreenElement !== undefined &&
        document.msFullscreenElement === null) ||
      (document.mozFullScreen !== undefined && !document.mozFullScreen) ||
      (document.webkitIsFullScreen !== undefined &&
        !document.webkitIsFullScreen)
    ) {
      if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(
          Element.ALLOW_KEYBOARD_INPUT
        );
      } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
      }
    } else {
      $("html").removeClass("fullscreen-button");
      if (document.cancelFullScreen) {
        document.cancelFullScreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }
    }
  });
  $(".cover-image").each(function () {
    var attr = $(this).attr("data-bs-image-src");
    if (typeof attr !== typeof undefined && attr !== false) {
      $(this).css("background", "url(" + attr + ") center center");
    }
  });
  $('body, .main-header form[role="search"] button[type="reset"]').on(
    "click keyup",
    function (event) {
      if (
        (event.which == 27 &&
          $('.main-header form[role="search"]').hasClass("active")) ||
        $(event.currentTarget).attr("type") == "reset"
      ) {
        closeSearch();
      }
    }
  );
  function closeSearch() {
    var $form = $('.main-header form[role="search"].active');
    $form.find("input").val("");
    $form.removeClass("active");
  }
  $(document).on(
    "click",
    '.main-header form[role="search"]:not(.active) button[type="submit"]',
    function (event) {
      event.preventDefault();
      var $form = $(this).closest("form"),
        $input = $form.find("input");
      $form.addClass("active");
      $input.focus();
    }
  );
  $(document).on(
    "click",
    '.main-header form[role="search"].active button[type="submit"]',
    function (event) {
      event.preventDefault();
      var $form = $(this).closest("form"),
        $input = $form.find("input");
      $("#showSearchTerm").text($input.val());
      closeSearch();
    }
  );
  $(".main-navbar .with-sub").on("click", function (e) {
    e.preventDefault();
    $(this).parent().toggleClass("show");
    $(this).parent().siblings().removeClass("show");
  });
  $(".dropdown-menu .main-header-arrow").on("click", function (e) {
    e.preventDefault();
    $(this).closest(".dropdown").removeClass("show");
  });
  $("#mainNavShow, #azNavbarShow").on("click", function (e) {
    e.preventDefault();
    $("body").addClass("main-navbar-show");
  });
  $("#mainContentLeftShow").on("click touch", function (e) {
    e.preventDefault();
    $("body").addClass("main-content-left-show");
  });
  $("#mainContentLeftHide").on("click touch", function (e) {
    e.preventDefault();
    $("body").removeClass("main-content-left-show");
  });
  $("#mainContentBodyHide").on("click touch", function (e) {
    e.preventDefault();
    $("body").removeClass("main-content-body-show");
  });
  $("body").append('<div class="main-navbar-backdrop"></div>');
  $(".main-navbar-backdrop").on("click touchstart", function () {
    $("body").removeClass("main-navbar-show");
  });
  $(document).on("click touchstart", function (e) {
    e.stopPropagation();
    var dropTarg = $(e.target).closest(".main-header .dropdown").length;
    if (!dropTarg) {
      $(".main-header .dropdown").removeClass("show");
    }
    if (window.matchMedia("(min-width: 992px)").matches) {
      var navTarg = $(e.target).closest(".main-navbar .nav-item").length;
      if (!navTarg) {
        $(".main-navbar .show").removeClass("show");
      }
      var menuTarg = $(e.target).closest(".main-header-menu .nav-item").length;
      if (!menuTarg) {
        $(".main-header-menu .show").removeClass("show");
      }
      if ($(e.target).hasClass("main-menu-sub-mega")) {
        $(".main-header-menu .show").removeClass("show");
      }
    } else {
      if (!$(e.target).closest("#mainMenuShow").length) {
        var hm = $(e.target).closest(".main-header-menu").length;
        if (!hm) {
          $("body").removeClass("main-header-menu-show");
        }
      }
    }
  });
  $("#mainMenuShow").on("click", function (e) {
    e.preventDefault();
    $("body").toggleClass("main-header-menu-show");
  });
  $(".main-header-menu .with-sub").on("click", function (e) {
    e.preventDefault();
    $(this).parent().toggleClass("show");
    $(this).parent().siblings().removeClass("show");
  });
  $(".main-header-menu-header .close").on("click", function (e) {
    e.preventDefault();
    $("body").removeClass("main-header-menu-show");
  });
  $(".card-header-right .card-option .fe fe-chevron-left").on(
    "click",
    function () {
      var a = $(this);
      if (a.hasClass("icofont-simple-right")) {
        a.parents(".card-option").animate({ width: "35px" });
      } else {
        a.parents(".card-option").animate({ width: "180px" });
      }
      $(this).toggleClass("fe fe-chevron-right").fadeIn("slow");
    }
  );
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
  var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
  );
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });
  eva.replace();
  $(document).ready(function () {
    $(".horizontalMenu-list li a").each(function () {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      if (this.href == pageUrl) {
        $(this).addClass("active");
        $(this).parent().addClass("active");
        $(this).parent().parent().prev().addClass("active");
        $(this).parent().parent().prev().click();
      }
    });
  });
  $(document).ready(function () {
    $(".horizontalMenu-list li a").each(function () {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      if (this.href == pageUrl) {
        $(this).addClass("active");
        $(this).parent().addClass("active");
        $(this).parent().parent().prev().addClass("active");
        $(this).parent().parent().prev().click();
      }
    });
    $(".horizontal-megamenu li a").each(function () {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      if (this.href == pageUrl) {
        $(this).addClass("active");
        $(this).parent().addClass("active");
        $(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .parent()
          .parent()
          .parent()
          .prev()
          .addClass("active");
        $(this).parent().parent().prev().click();
      }
    });
    $(".horizontalMenu-list .sub-menu .sub-menu li a").each(function () {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      if (this.href == pageUrl) {
        $(this).addClass("active");
        $(this).parent().addClass("active");
        $(this).parent().parent().parent().parent().prev().addClass("active");
        $(this).parent().parent().prev().click();
      }
    });
  });
  $(window).on("scroll", function (e) {
    if ($(this).scrollTop() > 0) {
      $("#back-to-top").fadeIn("slow");
    } else {
      $("#back-to-top").fadeOut("slow");
    }
  });
  $("#back-to-top").on("click", function (e) {
    $("html, body").animate({ scrollTop: 0 }, 0);
    return false;
  });
  $(".layout-setting").on("click", function (e) {
    if (!document.querySelector("body").classList.contains("dark-theme")) {
      $("body").addClass("dark-theme");
      $("body").removeClass("light-theme");
      localStorage.setItem("aziradarkMode", true);
      localStorage.removeItem("aziralightMode", false);
      $("#myonoffswitch2").prop("checked", true);
      $("#myonoffswitch5").prop("checked", true);
    } else {
      $("body").removeClass("dark-theme");
      $("body").addClass("light-theme");
      $("#myonoffswitch1").prop("checked", true);
      $("#myonoffswitch3").prop("checked", true);
      localStorage.setItem("aziralightMode", true);
      localStorage.removeItem("aziradarkMode", false);
    }
  });
  $(".default-menu").on("click", function () {
    var ww = document.body.clientWidth;
    if (ww >= 992) {
      $("body").removeClass("sidenav-toggled");
    }
  });
});
