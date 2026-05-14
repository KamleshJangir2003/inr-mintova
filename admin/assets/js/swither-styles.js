$(function () {
  $(document).on("click", "#myonoffswitch1", function () {
    if (this.checked) {
      $("body").addClass("light-theme");
      $("#myonoffswitch3").prop("checked", true);
      $("#myonoffswitch6").prop("checked", true);
      $("body").removeClass("dark-theme");
      $("body").removeClass("dark-theme");
      $("body").removeClass("color-header");
      $("body").removeClass("dark-header");
      $("body").removeClass("dark-menu");
      $("body").removeClass("gradient-menu");
      $("body").removeClass("gradient-header");
      $("body").removeClass("color-menu");
      localStorage.removeItem("aziraprimaryColor");
      localStorage.removeItem("aziraprimaryHoverColor");
      localStorage.removeItem("aziraprimaryBorderColor");
      document.querySelector("html")?.style.removeProperty("--dark-body");
      document.querySelector("html")?.style.removeProperty("--dark-theme");
      document
        .querySelector("html")
        ?.style.removeProperty("--primary-bg-color");
      document
        .querySelector("html")
        ?.style.removeProperty("--primary-hover-color");
      document
        .querySelector("html")
        ?.style.removeProperty("--primary-border-color");
      localStorage.removeItem("aziradarkPrimary");
      localStorage.removeItem("aziraprimaryBorderColor");
      localStorage.removeItem("aziraprimaryHoverColor");
      localStorage.removeItem("azirabgColor");
      localStorage.removeItem("aziradarkMode");
      $("#myonoffswitch1").prop("checked", true);
      $("#myonoffswitch5").prop("checked", false);
      $("#myonoffswitch8").prop("checked", false);
      checkOptions();
      const root = document.querySelector(":root");
      root.style = "";
    } else {
      $("body").removeClass("light-theme");
      localStorage.removeItem("aziralight-theme");
    }
    localStorageBackup();
  });
  $(document).on("click", "#myonoffswitch2", function () {
    if (this.checked) {
      $("body").addClass("dark-theme");
      $("#myonoffswitch5").prop("checked", true);
      $("#myonoffswitch8").prop("checked", true);
      $("body").removeClass("light-theme");
      $("body").removeClass("transparent-theme");
      $("body").removeClass("light-menu");
      $("body").removeClass("color-menu");
      $("body").removeClass("gradient-menu");
      $("body").removeClass("dark-menu");
      $("body").removeClass("dark-header");
      $("body").removeClass("color-header");
      $("body").removeClass("light-header");
      localStorage.removeItem("aziraprimaryColor");
      localStorage.removeItem("aziraprimaryHoverColor");
      localStorage.removeItem("aziraprimaryBorderColor");
      localStorage.removeItem("aziradarkPrimary");
      localStorage.removeItem("aziratransparentBgImgPrimary");
      localStorage.removeItem("aziratransparentBgImgprimaryTransparent");
      document
        .querySelector("html")
        ?.style.removeProperty("--primary-bg-color", localStorage.darkPrimary);
      document
        .querySelector("html")
        ?.style.removeProperty("--primary-bg-hover", localStorage.darkPrimary);
      document
        .querySelector("html")
        ?.style.removeProperty("--primary-bg-border", localStorage.darkPrimary);
      document
        .querySelector("html")
        ?.style.removeProperty("--dark-primary", localStorage.darkPrimary);
      localStorage.removeItem("aziraprimaryColor");
      localStorage.removeItem("aziraprimaryHoverColor");
      localStorage.removeItem("aziraprimaryBorderColor");
      localStorage.removeItem("aziraprimaryTransparent");
      localStorage.removeItem("aziratransparentBgColor");
      localStorage.removeItem("aziratransparentThemeColor");
      localStorage.removeItem("aziratransparentPrimary");
      $("#myonoffswitch3").prop("checked", false);
      $("#myonoffswitch6").prop("checked", false);
      $("#myonoffswitchTransparent").prop("checked", false);
      checkOptions();
      const root = document.querySelector(":root");
      root.style = "";
      names();
    } else {
      $("body").removeClass("dark-theme");
      localStorage.removeItem("aziradark-theme");
    }
    localStorageBackup();
  });
  $(document).on("click", "#myonoffswitch3", function () {
    if (this.checked) {
      $("body").addClass("light-menu");
      $("body").removeClass("color-menu");
      $("body").removeClass("dark-menu");
      $("body").removeClass("gradient-menu");
      localStorage.setItem("aziralightmenu", true);
      localStorage.removeItem("aziracolormenu");
      localStorage.removeItem("aziradarkmenu");
      localStorage.removeItem("aziragradientmenu");
    }
  });
  $(document).on("click", "#myonoffswitch4", function () {
    if (this.checked) {
      $("body").addClass("color-menu");
      $("body").removeClass("light-menu");
      $("body").removeClass("dark-menu");
      $("body").removeClass("gradient-menu");
      localStorage.setItem("aziracolormenu", true);
      localStorage.removeItem("aziralightmenu");
      localStorage.removeItem("aziradarkmenu");
      localStorage.removeItem("aziragradientmenu");
    }
  });
  $(document).on("click", "#myonoffswitch5", function () {
    if (this.checked) {
      $("body").addClass("dark-menu");
      $("body").removeClass("color-menu");
      $("body").removeClass("light-menu");
      $("body").removeClass("gradient-menu");
      localStorage.setItem("aziradarkmenu", true);
      localStorage.removeItem("aziralightmenu");
      localStorage.removeItem("aziracolormenu");
      localStorage.removeItem("aziragradientmenu");
    }
  });
  $(document).on("click", "#myonoffswitch25", function () {
    if (this.checked) {
      $("body").addClass("gradient-menu");
      $("body").removeClass("color-menu");
      $("body").removeClass("light-menu");
      $("body").removeClass("dark-menu");
      localStorage.setItem("aziragradientmenu", true);
      localStorage.removeItem("aziralightmenu");
      localStorage.removeItem("aziracolormenu");
      localStorage.removeItem("aziradarkmenu");
    }
  });
  $(document).on("click", "#myonoffswitch6", function () {
    if (this.checked) {
      $("body").addClass("light-header");
      $("body").removeClass("color-header");
      $("body").removeClass("dark-header");
      $("body").removeClass("gradient-header");
      localStorage.setItem("aziralightheader", true);
      localStorage.removeItem("aziracolorheader");
      localStorage.removeItem("aziradarkheader");
      localStorage.removeItem("aziragradientheader");
    }
  });
  $(document).on("click", "#myonoffswitch7", function () {
    if (this.checked) {
      $("body").addClass("color-header");
      $("body").removeClass("light-header");
      $("body").removeClass("dark-header");
      $("body").removeClass("gradient-header");
      localStorage.setItem("aziracolorheader", true);
      localStorage.removeItem("aziralightheader");
      localStorage.removeItem("aziradarkheader");
      localStorage.removeItem("aziragradientheader");
    }
  });
  $(document).on("click", "#myonoffswitch8", function () {
    if (this.checked) {
      $("body").addClass("dark-header");
      $("body").removeClass("color-header");
      $("body").removeClass("light-header");
      $("body").removeClass("gradient-header");
      localStorage.setItem("aziradarkheader", true);
      localStorage.removeItem("aziralightheader");
      localStorage.removeItem("aziracolorheader");
      localStorage.removeItem("aziragradientheader");
    }
  });
  $(document).on("click", "#myonoffswitch26", function () {
    if (this.checked) {
      $("body").addClass("gradient-header");
      $("body").removeClass("dark-header");
      $("body").removeClass("color-header");
      $("body").removeClass("light-header");
      localStorage.setItem("aziragradientheader", true);
      localStorage.removeItem("aziralightheader");
      localStorage.removeItem("aziracolorheader");
      localStorage.removeItem("aziradarkheader");
    }
  });
  $(document).on("click", "#myonoffswitch9", function () {
    if (this.checked) {
      $("body").addClass("layout-fullwidth");
      if (
        document.querySelector("body").classList.contains("horizontal") &&
        !document.querySelector("body").classList.contains("login-img")
      ) {
        checkHoriMenu();
      }
      $("body").removeClass("layout-boxed");
    }
  });
  $(document).on("click", "#myonoffswitch10", function () {
    if (this.checked) {
      $("body").addClass("layout-boxed");
      if (document.querySelector("body").classList.contains("horizontal")) {
        checkHoriMenu();
      }
      $("body").removeClass("layout-fullwidth");
    }
  });
  $(document).on("click", "#myonoffswitch11", function () {
    if (this.checked) {
      $("body").addClass("fixed-layout");
      $("body").removeClass("scrollable-layout");
    }
  });
  $(document).on("click", "#myonoffswitch12", function () {
    if (this.checked) {
      $("body").addClass("scrollable-layout");
      $("body").removeClass("fixed-layout");
    }
  });
  $(document).on("click", "#myonoffswitch13", function () {
    if (this.checked) {
      $("body").addClass("default-menu");
      hovermenu();
      $("body").removeClass("closed-menu");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("sideicon-menu");
      $("body").removeClass("sidenav-toggled");
      $("body").removeClass("hover-submenu");
      $("body").removeClass("hover-submenu1");
    }
  });
  $(document).on("click", "#myonoffswitch30", function () {
    if (this.checked) {
      $("body").addClass("closed-menu");
      hovermenu();
      $("body").addClass("sidenav-toggled");
      $("body").removeClass("default-menu");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("sideicon-menu");
      $("body").removeClass("hover-submenu");
      $("body").removeClass("hover-submenu1");
      localStorage.setItem("aziraclosedmenu", true);
      localStorage.removeItem("aziradefaultmenu");
      localStorage.removeItem("aziraicontextmenu");
      localStorage.removeItem("azirasideiconmenu");
      localStorage.removeItem("azirahoversubmenu");
      localStorage.removeItem("azirahoversubmenu1");
    }
  });
  $(document).on("click", "#myonoffswitch32", function () {
    if (this.checked) {
      $("body").addClass("hover-submenu");
      hovermenu();
      $("body").addClass("sidenav-toggled");
      $("body").removeClass("default-menu");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("sideicon-menu");
      $("body").removeClass("closed-menu");
      $("body").removeClass("hover-submenu1");
      localStorage.setItem("azirahoversubmenu", true);
      localStorage.removeItem("aziradefaultmenu");
      localStorage.removeItem("aziraclosedmenu");
      localStorage.removeItem("aziraicontextmenu");
      localStorage.removeItem("azirasideiconmenu");
      localStorage.removeItem("azirahoversubmenu1");
    }
  });
  $(document).on("click", "#myonoffswitch33", function () {
    if (this.checked) {
      $("body").addClass("hover-submenu1");
      hovermenu();
      $("body").addClass("sidenav-toggled");
      $("body").removeClass("default-menu");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("sideicon-menu");
      $("body").removeClass("closed-menu");
      $("body").removeClass("hover-submenu");
      localStorage.setItem("azirahoversubmenu1", true);
      localStorage.removeItem("aziradefaultmenu");
      localStorage.removeItem("aziraclosedmenu");
      localStorage.removeItem("aziraicontextmenu");
      localStorage.removeItem("azirasideiconmenu");
      localStorage.removeItem("azirahoversubmenu");
    }
  });
  $(document).on("click", "#myonoffswitch14", function () {
    if (this.checked) {
      $("body").addClass("icontext-menu");
      icontext();
      $("body").addClass("sidenav-toggled");
      $("body").removeClass("default-menu");
      $("body").removeClass("sideicon-menu");
      $("body").removeClass("closed-menu");
      $("body").removeClass("hover-submenu");
      $("body").removeClass("hover-submenu1");
      localStorage.setItem("aziraicontextmenu", true);
      localStorage.setItem("aziraicontextmenu", true);
      localStorage.removeItem("aziradefaultmenu");
      localStorage.removeItem("aziraclosedmenu");
      localStorage.removeItem("azirasideiconmenu");
      localStorage.removeItem("azirahoversubmenu");
      localStorage.removeItem("azirahoversubmenu1");
    }
  });
  $(document).on("click", "#myonoffswitch15", function () {
    if (this.checked) {
      $("body").addClass("sideicon-menu");
      hovermenu();
      $("body").addClass("sidenav-toggled");
      $("body").removeClass("default-menu");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("closed-menu");
      $("body").removeClass("hover-submenu");
      $("body").removeClass("hover-submenu1");
      localStorage.setItem("azirasideiconmenu", true);
      localStorage.removeItem("aziradefaultmenu");
      localStorage.removeItem("aziraclosedmenu");
      localStorage.removeItem("aziraicontextmenu");
      localStorage.removeItem("azirahoversubmenu");
      localStorage.removeItem("azirahoversubmenu1");
    }
  });
  $(document).on("click", "#myonoffswitch34", function () {
    if (this.checked) {
      $("body").removeClass("horizontal");
      $("body").removeClass("horizontal-hover");
      $(".main-content").removeClass("horizontal-content");
      $(".main-content").addClass("app-content");
      $(".main-container").removeClass("container");
      $(".main-container").addClass("container-fluid");
      $(".main-header").removeClass("hor-header");
      $(".main-header").addClass("side-header");
      $(".app-sidebar").removeClass("horizontal-main");
      $(".main-sidemenu").removeClass("container");
      $("#slide-left").removeClass("d-none");
      $("#slide-right").removeClass("d-none");
      $("body").addClass("sidebar-mini");
      localStorage.setItem("aziravertical", true);
      localStorage.removeItem("azirahorizontal");
      localStorage.removeItem("azirahorizontalHover");
      menuClick();
      if (
        document.querySelector("body").classList.contains("horizontal") &&
        !document.querySelector("body").classList.contains("login-img")
      ) {
        checkHoriMenu();
      }
      responsive();
    } else {
      $("body").removeClass("sidebar-mini");
      localStorage.setItem("azirasidebar-mini", "False");
    }
  });
  $(document).on("click", "#myonoffswitch35", function () {
    if (this.checked) {
      if (window.innerWidth >= 992) {
        let li = document.querySelectorAll(".side-menu li");
        li.forEach((e, i) => {
          e.classList.remove("is-expanded");
        });
        var animationSpeed = 300;
        var parent = $("[data-bs-toggle='sub-slide']").parents("ul");
        var ul = parent.find("ul:visible").slideUp(animationSpeed);
        ul.removeClass("open");
        var parent1 = $("[data-bs-toggle='sub-slide2']").parents("ul");
        var ul1 = parent1.find("ul:visible").slideUp(animationSpeed);
        ul1.removeClass("open");
      }
      $("body").addClass("horizontal");
      $(".main-content").addClass("horizontal-content");
      $(".main-content").removeClass("app-content");
      $(".main-container").addClass("container");
      $(".main-container").removeClass("container-fluid");
      $(".main-header").addClass("hor-header");
      $(".main-header").removeClass("side-header");
      $(".app-sidebar").addClass("horizontal-main");
      $(".main-sidemenu").addClass("container");
      $("body").removeClass("sidebar-mini");
      $("body").removeClass("sidenav-toggled");
      $("body").removeClass("horizontal-hover");
      $("body").removeClass("closed-menu");
      $("body").removeClass("hover-submenu");
      $("body").removeClass("hover-submenu1");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("sideicon-menu");
      localStorage.setItem("azirahorizontal", true);
      localStorage.removeItem("azirahorizontalHover");
      localStorage.removeItem("aziravertical");
      if (
        document.querySelector("body").classList.contains("horizontal") &&
        !document.querySelector("body").classList.contains("login-img")
      ) {
        document.querySelector(".horizontal .side-menu").style.flexWrap =
          "noWrap";
        checkHoriMenu();
        ActiveSubmenu();
        responsive();
        menuClick();
      }
    }
  });
  $(document).on("click", "#myonoffswitch111", function () {
    if (this.checked) {
      let li = document.querySelectorAll(".side-menu li");
      li.forEach((e, i) => {
        e.classList.remove("is-expanded");
      });
      var animationSpeed = 300;
      var parent = $("[data-bs-toggle='sub-slide']").parents("ul");
      var ul = parent.find("ul:visible").slideUp(animationSpeed);
      ul.removeClass("open");
      var parent1 = $("[data-bs-toggle='sub-slide2']").parents("ul");
      var ul1 = parent1.find("ul:visible").slideUp(animationSpeed);
      ul1.removeClass("open");
      $("body").addClass("horizontal-hover");
      $("body").addClass("horizontal");
      let subNavSub = document.querySelectorAll(".sub-slide-menu");
      subNavSub.forEach((e) => {
        e.style.display = "";
      });
      let subNav = document.querySelectorAll(".slide-menu");
      subNav.forEach((e) => {
        e.style.display = "";
      });
      document.querySelector(".horizontal .side-menu").style.flexWrap =
        "nowrap";
      $(".main-content").addClass("horizontal-content");
      $(".main-content").removeClass("app-content");
      $(".main-container").addClass("container");
      $(".main-container").removeClass("container-fluid");
      $(".main-header").addClass("hor-header");
      $(".main-header").removeClass("side-header");
      $(".app-sidebar").addClass("horizontal-main");
      $(".main-sidemenu").addClass("container");
      $("body").removeClass("sidebar-mini");
      $("body").removeClass("sidenav-toggled");
      $("body").removeClass("closed-menu");
      $("body").removeClass("hover-submenu");
      $("body").removeClass("hover-submenu1");
      $("body").removeClass("icontext-menu");
      $("body").removeClass("sideicon-menu");
      localStorage.setItem("azirahorizontalHover", true);
      localStorage.removeItem("azirahorizontal");
      localStorage.removeItem("aziravertical");
      HorizontalHovermenu();
      if (
        document.querySelector("body").classList.contains("horizontal") &&
        !document.querySelector("body").classList.contains("login-img")
      ) {
        checkHoriMenu();
      }
      responsive();
    }
  });
  $(document).on("click", "#myonoffswitch55", function () {
    if (this.checked) {
      $("body").addClass("rtl");
      $("body").removeClass("ltr");
      $("html[lang=en]").attr("dir", "rtl");
      $(".select2-container").attr("dir", "rtl");
      localStorage.setItem("azirartl", true);
      localStorage.removeItem("aziraltr");
      $("head link#style").attr("href", $(this));
      document
        .getElementById("style")
        ?.setAttribute(
          "href",
          "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css"
        );
      var carousel = $(".owl-carousel");
      $.each(carousel, function (index, element) {
        var carouselData = $(element).data("owl.carousel");
        carouselData.settings.rtl = true;
        carouselData.options.rtl = true;
        $(element).trigger("refresh.owl.carousel");
      });
      if (
        document.querySelector("body").classList.contains("horizontal") &&
        !document.querySelector("body").classList.contains("login-img")
      ) {
        checkHoriMenu();
      }
    }
  });
  $(document).on("click", "#myonoffswitch54", function () {
    if (this.checked) {
      $("body").addClass("ltr");
      $("body").removeClass("rtl");
      $("html[lang=en]").attr("dir", "ltr");
      $(".select2-container").attr("dir", "ltr");
      localStorage.setItem("aziraltr", true);
      localStorage.removeItem("azirartl");
      $("head link#style").attr("href", $(this));
      document
        .getElementById("style")
        ?.setAttribute(
          "href",
          "../assets/plugins/bootstrap/css/bootstrap.min.css"
        );
      var carousel = $(".owl-carousel");
      $.each(carousel, function (index, element) {
        var carouselData = $(element).data("owl.carousel");
        carouselData.settings.rtl = false;
        carouselData.options.rtl = false;
        $(element).trigger("refresh.owl.carousel");
        if (
          document.querySelector("body").classList.contains("horizontal") &&
          !document.querySelector("body").classList.contains("login-img")
        ) {
          checkHoriMenu();
        }
      });
    } else {
      $("body").removeClass("ltr");
      $("body").addClass("rtl");
      $(".select2-container").attr("dir", "rtl");
      localStorage.setItem("aziraltr", "false");
      $("head link#style").attr("href", $(this));
      document
        .getElementById("style")
        ?.setAttribute(
          "href",
          "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css"
        );
    }
  });
  $("#myonoffswitch03").click(function () {
    if (this.checked) {
      $("body").addClass("default-horizontal");
      $("body").removeClass("centerlogo-horizontal");
      localStorage.setItem("aziradefault-horizontal", "True");
    } else {
      $("body").removeClass("default-horizontal");
      localStorage.setItem("aziradefault-horizontal", "false");
    }
  });
  $("#myonoffswitch04").click(function () {
    if (this.checked) {
      $("body").addClass("centerlogo-horizontal");
      $("body").removeClass("default-horizontal");
      localStorage.setItem("aziracenterlogo-horizontal", "True");
    } else {
      $("body").removeClass("centerlogo-horizontal");
      localStorage.setItem("aziracenterlogo-horizontal", "false");
    }
  });
});
(function () {
  "use strict";
  if ($("body").hasClass("rtl")) {
    $("body").addClass("rtl");
    $("body").removeClass("ltr");
    $("html[lang=en]").attr("dir", "rtl");
    $(".select2-container").attr("dir", "rtl");
    localStorage.setItem("azirartl", true);
    localStorage.removeItem("aziraltr");
    $("head link#style").attr("href", $(this));
    document
      .getElementById("style")
      ?.setAttribute(
        "href",
        "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css"
      );
    var carousel = $(".owl-carousel");
    $.each(carousel, function (index, element) {
      var carouselData = $(element).data("owl.carousel");
      carouselData.settings.rtl = true;
      carouselData.options.rtl = true;
      $(element).trigger("refresh.owl.carousel");
    });
    if (
      document.querySelector("body").classList.contains("horizontal") &&
      !document.querySelector("body").classList.contains("login-img")
    ) {
      checkHoriMenu();
    }
  }
  if ($("body").hasClass("horizontal")) {
    if (window.innerWidth >= 992) {
      let li = document.querySelectorAll(".side-menu li");
      li.forEach((e, i) => {
        e.classList.remove("is-expanded");
      });
      var animationSpeed = 300;
      var parent = $("[data-bs-toggle='sub-slide']").parents("ul");
      var ul = parent.find("ul:visible").slideUp(animationSpeed);
      ul.removeClass("open");
      var parent1 = $("[data-bs-toggle='sub-slide2']").parents("ul");
      var ul1 = parent1.find("ul:visible").slideUp(animationSpeed);
      ul1.removeClass("open");
    }
    $("body").addClass("horizontal");
    $(".main-content").addClass("horizontal-content");
    $(".main-content").removeClass("app-content");
    $(".main-container").addClass("container");
    $(".main-container").removeClass("container-fluid");
    $(".main-header").addClass("hor-header");
    $(".main-header").removeClass("side-header");
    $(".app-sidebar").addClass("horizontal-main");
    $(".main-sidemenu").addClass("container");
    $("body").removeClass("sidebar-mini");
    $("body").removeClass("sidenav-toggled");
    $("body").removeClass("horizontal-hover");
    $("body").removeClass("closed-menu");
    $("body").removeClass("hover-submenu");
    $("body").removeClass("hover-submenu1");
    $("body").removeClass("icontext-menu");
    $("body").removeClass("sideicon-menu");
    if (
      document.querySelector("body").classList.contains("horizontal") &&
      !document.querySelector("body").classList.contains("login-img")
    ) {
      document.querySelector(".horizontal .side-menu").style.flexWrap =
        "noWrap";
      checkHoriMenu();
      ActiveSubmenu();
      menuClick();
      responsive();
    }
  }
  if ($("body").hasClass("horizontal-hover")) {
    let li = document.querySelectorAll(".side-menu li");
    li.forEach((e, i) => {
      e.classList.remove("is-expanded");
    });
    var animationSpeed = 300;
    var parent = $("[data-bs-toggle='sub-slide']").parents("ul");
    var ul = parent.find("ul:visible").slideUp(animationSpeed);
    ul.removeClass("open");
    var parent1 = $("[data-bs-toggle='sub-slide2']").parents("ul");
    var ul1 = parent1.find("ul:visible").slideUp(animationSpeed);
    ul1.removeClass("open");
    $("body").addClass("horizontal-hover");
    $("body").addClass("horizontal");
    let subNavSub = document.querySelectorAll(".sub-slide-menu");
    subNavSub.forEach((e) => {
      e.style.display = "";
    });
    let subNav = document.querySelectorAll(".slide-menu");
    subNav.forEach((e) => {
      e.style.display = "";
    });
    document.querySelector(".horizontal .side-menu").style.flexWrap = "nowrap";
    $(".main-content").addClass("horizontal-content");
    $(".main-content").removeClass("app-content");
    $(".main-container").addClass("container");
    $(".main-container").removeClass("container-fluid");
    $(".main-header").addClass("hor-header");
    $(".main-header").removeClass("side-header");
    $(".app-sidebar").addClass("horizontal-main");
    $(".main-sidemenu").addClass("container");
    $("body").removeClass("sidebar-mini");
    $("body").removeClass("sidenav-toggled");
    $("body").removeClass("closed-menu");
    $("body").removeClass("hover-submenu");
    $("body").removeClass("hover-submenu1");
    $("body").removeClass("icontext-menu");
    $("body").removeClass("sideicon-menu");
    HorizontalHovermenu();
    if (
      document.querySelector("body").classList.contains("horizontal") &&
      !document.querySelector("body").classList.contains("login-img")
    ) {
      checkHoriMenu();
    }
    responsive();
  }
  let bodyclosed = $("body").hasClass("closed-menu");
  if (bodyclosed) {
    $("body").addClass("closed-menu");
    hovermenu();
    $("body").addClass("sidenav-toggled");
  }
  let bodyicontext = $("body").hasClass("icontext-menu");
  if (bodyicontext) {
    $("body").addClass("icontext-menu");
    icontext();
    $("body").addClass("sidenav-toggled");
  }
  let bodyiconoverlay = $("body").hasClass("sideicon-menu");
  if (bodyiconoverlay) {
    $("body").addClass("sideicon-menu");
    hovermenu();
    $("body").addClass("sidenav-toggled");
  }
  let bodyhover = $("body").hasClass("hover-submenu");
  if (bodyhover) {
    $("body").addClass("hover-submenu");
    hovermenu();
    $("body").addClass("sidenav-toggled");
  }
  let bodyhover1 = $("body").hasClass("hover-submenu1");
  if (bodyhover1) {
    $("body").addClass("hover-submenu1");
    hovermenu();
    $("body").addClass("sidenav-toggled");
  }
  checkOptions();
})();
function resetData() {
  "use strict";
  $("#myonoffswitch3").prop("checked", true);
  $("#myonoffswitch1").prop("checked", true);
  $("#myonoffswitch6").prop("checked", true);
  $("#myonoffswitch9").prop("checked", true);
  $("#myonoffswitch11").prop("checked", true);
  $("#myonoffswitch13").prop("checked", true);
  $("#myonoffswitch07").prop("checked", true);
  $("#myonoffswitch03").prop("checked", true);
  $("#myonoffswitch54").prop("checked", true);
  $("#myonoffswitch34").prop("checked", true);
  $("body")?.removeClass("dark-theme");
  $("body")?.removeClass("dark-menu");
  $("body")?.removeClass("light-menu");
  $("body")?.removeClass("color-menu");
  $("body")?.removeClass("gradient-menu");
  $("body")?.removeClass("dark-header");
  $("body")?.removeClass("gradient-header");
  $("body")?.removeClass("light-header");
  $("body")?.removeClass("color-header");
  $("body")?.removeClass("layout-boxed");
  $("body")?.removeClass("icontext-menu");
  $("body")?.removeClass("sideicon-menu");
  $("body")?.removeClass("closed-menu");
  $("body")?.removeClass("hover-submenu");
  $("body")?.removeClass("hover-submenu1");
  $("body")?.removeClass("scrollable-layout");
  $("body")?.removeClass("sidenav-toggled");
  $("body")?.removeClass("leftbgimage1");
  $("body")?.removeClass("leftbgimage2");
  $("body")?.removeClass("leftbgimage3");
  $("body")?.removeClass("leftbgimage4");
  $("body")?.removeClass("leftbgimage5");
  $("body")?.removeClass("centerlogo-horizontal");
  $("body").removeClass("horizontal");
  $("body").removeClass("horizontal-hover");
  $(".main-content").removeClass("horizontal-content");
  $(".main-content").addClass("app-content");
  $(".main-container").removeClass("container");
  $(".main-container").addClass("container-fluid");
  $(".main-header").removeClass("hor-header");
  $(".main-header").addClass("side-header");
  $(".app-sidebar").removeClass("horizontal-main");
  $(".main-sidemenu").removeClass("container");
  $("#slide-left").removeClass("d-none");
  $("#slide-right").removeClass("d-none");
  $("body").addClass("sidebar-mini");
  localStorage.setItem("aziravertical", true);
  localStorage.removeItem("azirahorizontal");
  localStorage.removeItem("azirahorizontalHover");
  menuClick();
  if (
    document.querySelector("body").classList.contains("horizontal") &&
    !document.querySelector("body").classList.contains("login-img")
  ) {
    checkHoriMenu();
  }
  responsive();
  $("body").addClass("ltr");
  $("body").removeClass("rtl");
  $("html[lang=en]").attr("dir", "ltr");
  $(".select2-container").attr("dir", "ltr");
  localStorage.setItem("aziraltr", true);
  localStorage.removeItem("azirartl");
  $("head link#style").attr("href", $(this));
  document
    .getElementById("style")
    ?.setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.min.css");
  var carousel = $(".owl-carousel");
  $.each(carousel, function (index, element) {
    var carouselData = $(element).data("owl.carousel");
    carouselData.settings.rtl = false;
    carouselData.options.rtl = false;
    $(element).trigger("refresh.owl.carousel");
    if (
      document.querySelector("body").classList.contains("horizontal") &&
      !document.querySelector("body").classList.contains("login-img")
    ) {
      checkHoriMenu();
    }
  });
}
function checkOptions() {
  "use strict";
  if (document.querySelector("body").classList.contains("horizontal")) {
    $("#myonoffswitch35").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("horizontal-hover")) {
    $("#myonoffswitch111").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("rtl")) {
    $("#myonoffswitch55").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("light-header")) {
    $("#myonoffswitch6").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("color-header")) {
    $("#myonoffswitch7").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("gradient-header")) {
    $("#myonoffswitch26").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("dark-header")) {
    $("#myonoffswitch8").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("light-menu")) {
    $("#myonoffswitch3").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("color-menu")) {
    $("#myonoffswitch4").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("gradient-menu")) {
    $("#myonoffswitch25").prop("checked", true);
  }
  if (document.querySelector("body").classList.contains("dark-menu")) {
    $("#myonoffswitch5").prop("checked", true);
  }
}
checkOptions();
if (!localStorage.getItem("azirartl") && !localStorage.getItem("aziraltr")) {
}
if (!localStorage.getItem("aziralight") && !localStorage.getItem("aziradark")) {
}
if (
  !localStorage.getItem("aziravertical") &&
  !localStorage.getItem("azirahorizontal") &&
  !localStorage.getItem("azirahorizontalHover")
) {
}
if (
  !localStorage.getItem("aziradefaultmenu") &&
  !localStorage.getItem("aziraclosedmenu") &&
  !localStorage.getItem("aziraicontextmenu") &&
  !localStorage.getItem("azirasideiconmenu") &&
  !localStorage.getItem("azirahoversubmenu") &&
  !localStorage.getItem("azirahoversubmenu1")
) {
}
if (
  !localStorage.getItem("aziradefaultbody") &&
  !localStorage.getItem("azirabodystyle")
) {
}
if (
  !localStorage.getItem("azirafullwidth") &&
  !localStorage.getItem("aziraboxedwidth")
) {
}
if (
  !localStorage.getItem("azirafixed") &&
  !localStorage.getItem("azirascrollable")
) {
}
if (
  !localStorage.getItem("aziralightmenu") &&
  !localStorage.getItem("aziracolormenu") &&
  !localStorage.getItem("aziradarkmenu") &&
  !localStorage.getItem("aziragradientmenu")
) {
}
if (
  !localStorage.getItem("aziralightheader") &&
  !localStorage.getItem("aziracolorheader") &&
  !localStorage.getItem("aziradarkheader") &&
  !localStorage.getItem("aziragradientheader")
) {
}
