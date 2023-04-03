window.onscroll = function () {
  if (window.innerWidth > 769) {
    myFunction();
  }
};

$(window).on("resize", function () {
  if (window.innerWidth > 769) {
    $(".brand-name a > span:first-child").css("font-size", "34px");
    $(".brand-name a > span:last-child").css("font-size", "21px");
    window.onscroll = function () {
      if (window.innerWidth > 769) {
        myFunction();
      }
    };
  } else {
    $(".brand-name a > span:first-child").css("font-size", "24px");
    $(".brand-name a > span:last-child").css("font-size", "14px");
  }
});

function myFunction() {
  if (document.documentElement.scrollTop > 50) {
    $(".brand-name a > span:first-child").css("font-size", "24px");
    $(".brand-name a > span:last-child").css("font-size", "14px");
  } else {
    $(".brand-name a > span:first-child").css("font-size", "34px");
    $(".brand-name a > span:last-child").css("font-size", "21px");
  }
}

$("button.mobile-menu").on("click", function () {
  $(this).find("span").toggleClass("active");
});

$("#bars").on("click", function () {
  console.log("dsfsd");
  let el = $("#mobile");
  el.toggleClass("down");
});
