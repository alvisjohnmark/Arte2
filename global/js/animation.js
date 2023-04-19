window.onscroll = function () {
  if (window.innerWidth > 769) {
    myFunction();
  }
};

$(window).on("resize", function () {
  if (window.innerWidth > 769) {
    $(".brand-name a > span:first-child").css("font-size", "2rem");
    $(".brand-name a > span:last-child").css("font-size", "1.2rem");
    window.onscroll = function () {
      if (window.innerWidth > 769) {
        myFunction();
      }
    };
  } else {
    $(".brand-name a > span:first-child").css("font-size", "1.3rem");
    $(".brand-name a > span:last-child").css("font-size", ".8rem");
  }
});

function myFunction() {
  if (document.documentElement.scrollTop > 50) {
    $(".brand-name a > span:first-child").css("font-size", "1.3rem");
    $(".brand-name a > span:last-child").css("font-size", ".8rem");
  } else {
    $(".brand-name a > span:first-child").css("font-size", "2rem");
    $(".brand-name a > span:last-child").css("font-size", "1.2rem");
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
