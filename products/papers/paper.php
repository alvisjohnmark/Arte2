<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../css/style.css" rel="stylesheet" />
    <link href="../../css/product_showcase.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>Arte crafts</title>
</head>

<body>
    <header>
        <div id="header">
            <div id="bars">
                <button class="mobile-menu">
                    <span></span>
                </button>
            </div>
            <div class="brand-name">
                <a href="../../index.php">
                    <span>Arte</span>
                    <span>crafts</span>
                </a>
            </div>
            <navbar class="nav-desk">
                <ul>
                    <li><a href="./products/paper.php">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li>
                        <a href="../../pages/wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="../../forms/login.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="../../pages/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span>0</span>
                        </a>
                    </li>
                </ul>
            </navbar>
        </div>
        <div id="mobile" class="mobile">
            <navbar class="mobile-nav">
                <ul>
                    <li><a href="./pages/profile.php">Profile</a></li>
                    <li><a href="./pages/wishlist.php">Wishlist</a></li>
                    <li>
                        <a href="./pages/wishlist.php">About</a>
                    </li>
                    <li>
                        <a href="./forms/login.php">Contact</a>
                    </li>
                </ul>
            </navbar>
        </div>
    </header>
    <main>
        <section class="paper">
            <div class="container">
                <div class="outer-paper-products">
                    <ul>
                        <a href="../../index.php">
                            <li>Products</li>
                        </a>
                        <span>❯</span>
                        <a href="../papers.php">
                            <li>Paper</li>
                        </a>
                        <span>❯</span>
                        <li id="name"></li>
                    </ul>
                    <div class="item" data-beat="true">
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <footer></footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                method: "GET",
                url: "../../server/cart/getItemsQnty.php",
                success: async function (response) {
                    let result = await JSON.parse(response)
                    if (result.data[0][0]) {
                        $(".nav-desk").find("span").text(result.data[0][0])
                    } else {
                        console.log("No User");
                    }

                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        });

        function notify() {
            let div = document.createElement("div");
            div.innerHTML = "Item Added!"
            div.classList.add("notify")
            $("body").prepend(div);

            setTimeout(function () {
                if ($('.notify').length > 0) {
                    div.remove();
                }
            }, 2000)
        }

        $(document).ready(function () {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            let value = params.itemID; // "some_value"
            if (params.add == "True") {
                notify();
            }

            $.ajax({
                method: "GET",
                url: "../../server/customer.php",
                success: function (response) {
                    let result = JSON.parse(response)
                    renderItem(value, result.data)
                    wishlist(value, result.data)
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        });


        //RENDER PRODUCT AND ADD TO CART
        function renderItem(value, userLoggedIn) {

            $.ajax({
                method: "GET",
                url: `../../server/item/get.php?itemID=${value}`,
                success: async function (response) {
                    let result = await JSON.parse(response)
                    result.data ? setElements(result.data) : console.log("No Item");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })

            function setElements(item) {
                let name = item["name"];
                let price = item["price"];
                let image = item["img"];
                let stock = item["stock"];
                let src = `../../assets/images/${image}`
                $("section .item").append(

                    $(`<div class="item-wrapper">
              <div class="item-image">
                <img src=${src} loading="lazy">
              </div>
              <div class="item-detail">
                <p>${name}</p>
                <p>₱${price}.00</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.</p>
                <div class="wishlist" data-beat=${true}><i class="fa fa-heart wishlist-add" aria-hidden="true"></i>
                </div>
                <div class="lower">
                  <div class="quantity-wrapper">
                    <p>Stocks remaining: <b id=stock>${stock}</b>.</p>
                    <p>Each pack contains <b>6</b> pieces.</p>
                    <div class="quantity">
                      <label for="qnty"><p>Quantity</p></label>
                      <input type="number" id="qnty" name="qnty" value="1" min="1" max="${stock}">
                      <div class="inc-dec">
                        <button id="inc"><i class="fa fa-caret-up" aria-hidden="true"></i></button>
                        <button id="dec"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>
                  <button id="cart" class="add-to-cart">Add to cart</button>
                </div>
              </div>
            </div>`
                    ));
                $(".outer-paper-products #name").append(
                    $(`<b>${name}</b>`)
                )

                //this handles the quantity function and assures that quantity is not
                //over than the number of stocks nor less than

                let s = Number($('#stock').text())

                $(document).on('input', "#qnty", function (e) {
                    let cur = Number($("#qnty").val())
                    if (cur == 0) {

                        ($("#qnty").val(1))
                    } else {



                        if (cur > s) { //change the number here
                            let lastDigi = Math.floor(cur / 10);
                            $("#qnty").val(lastDigi)
                            return
                        }
                        ($("#qnty").val(cur))
                    }
                })

                $(document).on('click', "#inc", function () {
                    let cur = Number($("#qnty").val())
                    if (cur == item["stock"] || cur === item["stock"]) {
                        return
                    }

                    cur += 1
                    $("#qnty").val(cur)
                });

                $(document).on('click', "#dec", function () {
                    let cur = $("#qnty").val()
                    if (cur == 1 || cur === 1) {
                        return
                    }
                    cur -= 1
                    $("#qnty").val(cur)
                });
            }




            //add to cart 
            $(document).on('click', "#cart", function (i) {
                if (!userLoggedIn) {
                    window.location.href = "http://localhost/ARTE/forms/login.php";
                    return
                }
                let qnty = $("#qnty").val()

                if (qnty === 0 || qnty === '0') return;
                //itemID is very importanting
                console.log(qnty);
                let data = { quantity: qnty, itemID: value }
                $.ajax({
                    method: "POST",
                    url: "../../server/cart/add.php",
                    data: data,
                    success: function (response) {
                        let result = response
                        console.log(result);
                        const urlParams = new URLSearchParams(window.location.search);
                        urlParams.set('add', 'True');
                        window.location.search = urlParams;
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                    }
                })

            });





        }



        //WISHLIST
        function wishlist(value, userLoggedIn) {

            let hasBeat = true;
            $.ajax({
                method: "POST",
                url: '../../server/wishlist/exist.php',
                data: { itemID: value },
                success: async function (response) {
                    let result = await JSON.parse(response)
                    if (result.data) {
                        $(".wishlist-add").addClass("beat");
                        hasBeat = true;
                        console.log("Triggered add");
                    } else {
                        console.log("Triggered del");
                        "No Item";
                        hasBeat = false;
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })

            $(document).on('click', ".wishlist-add", function () {
                if (!userLoggedIn) {
                    window.location.href = "http://localhost/ARTE/forms/login.php";
                }
                if ($(this).hasClass("beat")) {
                    hasBeat = false;
                    console.log(hasBeat);
                    $(this).removeClass("beat");
                } else {
                    hasBeat = true;
                    console.log(hasBeat);
                    $(this).addClass("beat");
                }
            });

            $(window).on('beforeunload', function () {
                let data = { itemID: value }
                console.log(hasBeat);
                if (hasBeat) {
                    $.ajax({
                        method: "POST",
                        url: "../../server/wishlist/add.php",
                        data: data,
                        success: function (response) {
                            let result = JSON.parse(response)
                            console.log(response);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr, status, error);
                        }
                    })
                    console.log("ADD");
                } else {
                    $.ajax({
                        method: "POST",
                        url: "../../server/wishlist/delete.php",
                        data: data,
                        success: function (response) {
                            let result = JSON.parse(response)
                            console.log(response);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr, status, error);
                        }
                    })
                    console.log("DELETE");
                }
            });
        }


    </script>
</body>

</html>