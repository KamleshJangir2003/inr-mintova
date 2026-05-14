jQuery(".demo-icon").click(function () {
  if (jQuery(".demo_changer").hasClass("active")) {
    jQuery(".demo_changer").animate({ right: "-270px" }, function () {
      jQuery(".demo_changer").removeClass("active");
    });
  } else {
    jQuery(".demo_changer").animate({ right: "0px" }, function () {
      jQuery(".demo_changer").addClass("active");
    });
  }
});
const ps5 = new PerfectScrollbar(".sidebar-right1", {
  useBothWheelAxes: true,
  suppressScrollX: true,
});
jQuery(".page").click(function () {
  if (jQuery(".demo_changer").hasClass("active")) {
    jQuery(".demo_changer").animate({ right: "-270px" }, function () {
      jQuery(".demo_changer").removeClass("active");
    });
  }
});
