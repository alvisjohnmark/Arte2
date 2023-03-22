window.onscroll = function () {
  myFunction();
};

function myFunction() {
  if (document.documentElement.scrollTop > 50) {
    document.querySelector(".brand-name a > span:first-child").style =
      "font-size : 24px";
    document.querySelector(".brand-name a > span:last-child").style =
      "font-size : 14px";
  } else {
    document.querySelector(".brand-name a > span:first-child").style =
      "font-size : 34px";
    document.querySelector(".brand-name a > span:last-child").style =
      "font-size : 21px";
  }
}

function fadeOut(params) {
  const outterEl = document.querySelector(".paper .item");
  const el = params.parentNode;
  console.log("Fired");
  viewItem(el);
  outterEl.style = "transform: translateX(0px)";
  outterEl.style.opacity = 1;
  el.parentNode.style = "transform: translateX(50px)";
  el.parentNode.style.opacity = 0;
  el.parentNode.style.visibility = "hidden";
}

function viewItem(params) {
  let ul = document.querySelector(".outer-paper-products ul");
  if (ul.children.length >= 5) {
    return;
  }
  let itemText = params.children[1].innerHTML;
  let itemPrice = params.children[2].innerHTML;
  let itemDetail = document.querySelector(".inner-outer-products .item-detail");
  itemDetail.children[1].innerHTML = itemPrice;
  itemDetail.children[0].innerHTML = itemText;
  let newLi = document.createElement("li");
  let newSpan = document.createElement("span");
  newLi.innerHTML = itemText;
  newSpan.innerHTML = "❯";
  ul.appendChild(newSpan);
  ul.appendChild(newLi);
}

function returnToPaper() {
  let ul = document.querySelector(".outer-paper-products ul");
  if (ul.children.length <= 4) {
    return;
  }
  const paperProducts = document.querySelector(".paper .paper-products");
  const outterEl = document.querySelector(".paper .item");
  let len = ul.children.length;
  ul.children[len - 1].remove();
  ul.children[len - 2].remove();
  paperProducts.style = "transform: translateX(0px)";
  paperProducts.style.opacity = 1;
  paperProducts.style.display = "grid";
  outterEl.style = "transform: translateX(-50px)";
  outterEl.style.visibility = "hidden";
}

//Animation for favorites

let favorites = document.querySelectorAll(".fa-heart");

favorites.forEach((favorite) => {
  favorite.addEventListener("click", () => {
    if (favorite.classList.contains("beat")) {
      favorite.classList.remove("beat");
      return;
    }
    favorite.classList.add("beat");
  });
});
