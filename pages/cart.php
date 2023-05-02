<?php include "../global/user.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.ico" />
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
                <a href="../index.php">
                    <span>Arte</span>
                    <span>crafts</span>
                </a>
            </div>
            <navbar class="nav-desk">
                <ul>
                    <li><a href="./products/paper.php">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li>
                        <a href="./wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "./profile.php" : print "../forms/login.php" ?>><i
                                class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "./cart.php" : print "../forms/login.php" ?>><i
                                class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span>0</span>
                        </a>
                    </li>
                </ul>
            </navbar>
        </div>
        <div id="mobile" class="mobile">
            <navbar class="mobile-nav">
                <ul>
                    <li><a href="./profile.php">Profile</a></li>
                    <li><a href="./wishlist.php">Wishlist</a></li>
                    <li>
                        <a href="./wishlist.php">About</a>
                    </li>
                    <li>
                        <a href="../forms/login.php">Contact</a>
                    </li>
                </ul>
            </navbar>
        </div>
    </header>

    <section>
        <div class="container">
            <p id="cart-id" style="display: none;">Cart ID <span>
                    <!--Gets the cart ID of the user and use it as refernce for sql processing-->
                    <?php if (isset($_SESSION["customerID"])) {
                        echo $_SESSION["customerID"];
                    } else {
                        echo 0;
                    } ?>
                </span></p>
            <h1>My shopping cart</h1>
            <input type="checkbox" class="check" name=select-all>
            <label for=select-all class="label-select-all">
                <svg viewBox="0 0 100 100" height="50" width="50" class="select-all-svg">
                    <rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
                    <g transform="translate(0,-952.36216)" id="layer1">
                        <path id="path4146"
                            d="m 55,978 c -73,19 46,71 15,2 C 60,959 13,966 30,1007 c 12,30 61,13 46,-23" fill="none"
                            stroke="black" stroke-width="3" class="path1" />
                    </g>
                </svg>
                <span>Select All</span>
            </label>

            <div class="delete">
                <div class="delete-button">
                    <button id="deleteBtn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
                <div class="delete-confirmation">
                    <div style="display: flex;">
                        <button>Confirm</button>
                        <button>Cancel</button>
                    </div>
                </div>
            </div>

            <div class="products">
                <ul></ul>
            </div>
            <div class="totals">
                <div class="totals-item">
                    <label>Subtotal</label>
                    <div class="totals-value" id="cart-subtotal">₱<span>0</span>.00</div>
                </div>
                <div class="totals-item">
                    <label>Shipping</label>
                    <div class="totals-value" id="cart-shipping">₱80.00</div>
                </div>
                <div class="totals-item totals-item-total">
                    <label>Grand Total</label>
                    <div class="totals-value" id="cart-total">₱<span>0</span>.00</div>
                </div>
            </div>
            <button class="checkout">Checkout</button>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="links">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Contribute</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div>
                        <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by
                            <a href="#">ArteArts</a>.
                        </p>
                    </div>

                    <div class="icons">
                        <ul class="social-icons">
                            <li><a class="facebook" href="#"><i class="fa fa-facebook"> </i></a></li>
                            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a class="github" href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../global/js/animation.js"></script>
    <script>



        $(document).ready(function () {

            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            let value = params.itemID; //gte the value in params
            if (sessionStorage.getItem("add") == "True") {
                notify("Item(s) Deleted!");
            }
            sessionStorage.setItem("add", "False") //stores in a session
            getItems(); //gets the items and render them to the page
            //gets the quantity of items in cart
            $.ajax({
                method: "GET",
                url: "../server/cart/getItemsQnty.php",
                success: function (response) {
                    let result = JSON.parse(response)
                    if (result.data) {
                        $(".nav-desk").find("span").text(result.data)
                    } else {
                        console.log("No User");
                    }

                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        });

        function notify(message) {
            // if ($(".notify") >= 1) return
            let div = document.createElement("div");
            div.innerHTML = message
            div.classList.add("notify")
            $("body").prepend(div);

            setTimeout(function () {
                div.remove();
            }, 2000)
        }


        function getItems() {
            $.ajax({
                method: "GET",
                url: "../server/cart/getAll.php",
                success: function (response) {
                    let result = JSON.parse(response)
                    console.log(result.data);
                    result.data ? setElements(result) : console.log("No customer");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        }

        function setElements(params) {
            params.data.length > 0 ?
                params.data.forEach(item => {
                    let name = item["name"];
                    let price = item["price"];
                    let image = item["img"];
                    let itemID = item["itemID"];
                    let quantity = item["quantity"];
                    let stock = item["stock"];
                    let kind = item["kind"]
                    let src = `../assets/images/${image}`

                    $("section .products ul").append(
                        $(`<li><div class="line"></div>
                <div class="product-wrapper">
                    <input type="checkbox" class="check" name=${itemID}>
                        <svg viewBox="0 0 100 100" height="50" width="50">
                            <rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
                            <g transform="translate(0,-952.36216)" id="layer1">
                                <path id="path4146"
                                    d="m 55,978 c -73,19 46,71 15,2 C 60,959 13,966 30,1007 c 12,30 61,13 46,-23"
                                    fill="none" stroke="black" stroke-width="3" class="path1" />
                            </g>
                        </svg> </span>

                        <div class="product">
                            <div class="product-image">
                                <img src=${src}
                                    alt="">
                            </div>
                            <div class="product-title">
                                <p>${name}</p>
                                <p>${kind}</p>
                            </div>
                            <div class="product-price">
                                <p>₱<span>${price}</span>.00</p>
                            </div>
                            <div class="product-quantity">
                                <input class="qnty" type="number" min="1" max=${stock} value=${quantity > stock ? stock : quantity}>
                            </div>
                            <div class="product-total">
                                <p>₱<span>${price * quantity}</span>.00</p>
                            </div>
                        </div>
                </div></li>`));
                }) : $("section .totals").prepend("<div class='no-items-msg'><span>No items in your cart.</span></div>")
        }

        //manages the checkboxes
        $(document).on("click", ".product-wrapper", (function (e) {
            if ($(e.target).is("input")) {
                return
            }

            let checkBox = $(this).children(".check");
            console.log(checkBox);
            if (checkBox.prop("checked")) {
                checkBox.prop("checked", false)
            } else {
                checkBox.prop("checked", true)
            }
            if ($(".check:checked").length <= 0) {
                $(".delete-confirmation").removeClass("expand")
            }
            calculateTotal()
        }));

        //calculateTotal: Calculate the overall total of products including shipping

        function calculateTotal(all = null) {
            let total = 0
            $(".check:checked").each(function (index) {
                if (all && index == 0) {
                    return
                }
                if ($(this).parent().find(".product-total").find("span").length > 1) return;
                let val = parseFloat($(this).parent().find(".product-total").find("span").text())
                total += val
            })
            if (total) {
                $("#cart-subtotal span").text(total)
                $("#cart-total span").text(total + 80)
            } else {
                $("#cart-subtotal span").text(00)
                $("#cart-total span").text(00)
            }
        }

        //calculates the total of an item: price * quantity of an item
        function calculate(e, quantity, price) {
            let pric = parseFloat($(price).text())
            product = quantity * pric;
            $(e).text(product);
        }


        //this is for handling changes in the input.
        //to prevent multiple query every change in the input,
        //it calls a query every 2 seconds of inactivity from input
        let time_out_running = null;
        $(document).on('input', ".qnty", function (e) {
            let quantity = parseFloat($(e.target).val())
            let node = ($(e.target).parent().parent().find(".product-total").find("span"))
            let price = ($(e.target).parent().parent().find(".product-price").find("span"));

            quantitySum()
            calculate(node, quantity, price)
            calculateTotal()

            if (time_out_running) {
                clearTimeout(time_out_running);
                time_out_running = null;
            }

            if (!time_out_running) {
                time_out_running = setTimeout(function () {
                    $.each($(".product-wrapper"), function (index, el) {
                        updateItems(el);
                    })
                }, 2000)
            }
        })

        //this gets the total quantity of all items
        //this function is called everytime there are changes in the inputs
        function quantitySum() {
            let sum = 0
            $('.qnty').each(function () {
                sum += parseFloat($(this).val())
            })
            $(".nav-desk").find("span").text(sum)
        }


        function removeItemFromDB(el) {
            let itemID = $(el).parent().find("input").attr("name");
            let data = { "itemID": itemID }
            $.ajax({
                method: "POST",
                url: "../server/cart/delete.php",
                data: data,
                success: function (response) {
                    let result = response
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        }

        function updateItems(el) {
            let quantity = $(el).find(".product-quantity").find(".qnty").val()
            let itemID = $(el).find("input").attr("name")
            const data = { quantity: quantity, itemID: itemID }
            $.ajax({
                method: "POST",
                url: "../server/cart/update.php",
                data: data,
                success: function (response) {
                    let result = response
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        }

        $(".select-all-svg").click(function () {
            //TODO: check the Select all checkbox when all products are selected

            let checkBoxes = $(".check");
            if (checkBoxes.prop("checked")) {
                checkBoxes.prop("checked", false)
            } else {
                checkBoxes.prop("checked", true)
            }
            calculateTotal(true)

        })


        $(document).on("click", ".delete-confirmation button:first-child", function () {
            console.log("Fired");
            $(".check:checked").map(function (i, el) {
                $(el).parent().slideUp(300, function () {
                    removeItemFromDB(el)
                    $(el).parent().remove()
                });
            })
            $(".delete-confirmation").removeClass("expand")

            //setTimeout to make sure the item is set before the page reloads
            setTimeout(function () {
                sessionStorage.setItem("add", "True");
                location.reload()
            }, 500);
        })


        $(document).on("click", ".delete-confirmation button:last-child", function () {
            $(".delete-confirmation").removeClass("expand")
            $(".check:checked").map(function (i, el) {
                $(el).prop("checked", false)
            })
            calculateTotal()

        })


        $(".delete").click(function () {
            if ($(".check:checked").length <= 0) {
                notify("Please select item(s)")
                return
            }
            $(".delete-confirmation").addClass("expand")
        })

        //Checkout
        $(".checkout").click(function () {
            if ($(".check:checked").length <= 0) {
                notify("Please select item(s)")
                return
            }
            let items_list = []

            $(".check:checked").each(function () {
                items_list.push(parseInt($(this).attr("name")));
            })

            let cartID = $("#cart-id").find("span").text().trim()
            console.log(cartID);

            let url = `http://localhost/ARTE/pages/checkout.php?items=${items_list}&cartID=${cartID}`
            window.location = url
        })

    </script>
</body>

</html>