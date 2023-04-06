<?php echo ""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/cart.css">
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
                        <a href="./forms/login.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="./cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
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

            <h1>Shopping Cart</h1>
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
            </div>
            <div class="totals">
                <div class="totals-item">
                    <label>Subtotal</label>
                    <div class="totals-value" id="cart-subtotal">₱<span>100</span>.00</div>
                </div>
                <div class="totals-item">
                    <label>Shipping</label>
                    <div class="totals-value" id="cart-shipping">₱80.00</div>
                </div>
                <div class="totals-item totals-item-total">
                    <label>Grand Total</label>
                    <div class="totals-value" id="cart-total">₱<span>100</span>.00</div>
                </div>
            </div>
            <button class="checkout">Checkout</button>
        </div>
    </section>

    <footer>
        asd
    </footer>
    <!-- <script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script> -->
    <!-- <script src="./js/animation.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>

        $(document).ready(function () {
            $.ajax({
                method: "GET",
                url: "../server/cart/getItemsQnty.php",
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


        function calculateTotal(total = null) {
            console.log("dsdsd");
            if (!total) {
                let subTotal = 0;
                ($(".product-total p span").each(function (index) {
                    subTotal += parseFloat($(this).text());
                }));
                $("#cart-subtotal span").text(subTotal)
                $("#cart-total span").text(subTotal + 80)
            } else {
                $("#cart-subtotal span").text(total)
                $("#cart-total span").text(total + 80)
            }
        }

        function getItems() {
            $.ajax({
                method: "GET",
                url: "../server/cart/getAll.php",
                success: async function (response) {
                    let result = await JSON.parse(response)
                    console.log(result.data);
                    result.data ? setElements(result) : console.log("No customer");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        }

        function setElements(params) {
            let initialTotal = 0;
            params.data.forEach(item => {
                let name = item["name"];
                let price = item["price"];
                let image = item["img"];
                let itemID = item["itemID"];
                let quantity = item["quantity"];
                let kind = item["kind"]
                let src = `../assets/images/${image}`
                initialTotal += (price * quantity)
                $("section .products").append(
                    $(`<div class="line"></div>
                <div class="product-wrapper">
                    <input type="checkbox" class="check" name=${itemID}>
                    <label for=${itemID} class="label">
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
                                <input class="qnty" type="number" min="1" value=${quantity}>
                            </div>
                            <div class="product-total">
                                <p>₱<span>${price * quantity}</span>.00</p>
                            </div>
                        </div>
                    </label>
                </div>`));
            })
            calculateTotal(initialTotal)
        }

        $(document).ready(function () {

            getItems();
            let checked
            $(document).on("click", ".product-wrapper", (function (e) {
                console.log($(e.target));
                if ($(e.target).is("input")) {
                    return
                }

                let checkBox = $(this).children(".check");
                if (checkBox.prop("checked")) {
                    checkBox.prop("checked", false)
                } else {
                    checkBox.prop("checked", true)
                }
                if ($(".check:checked").length <= 0) {
                    console.log("Zero");
                    $(".delete-confirmation").removeClass("expand")
                }
            }));

            let s = parseFloat($('.qnty').val())

            function calculate(e, quantity, price) {
                let pric = parseFloat($(price).text())
                product = quantity * pric;
                $(e).text(product);
            }

            $(document).on('input', ".qnty", function (e) {
                let quantity = parseFloat($(e.target).val())
                let node = ($(e.target).parent().parent().find(".product-total").find("span"))
                let price = ($(e.target).parent().parent().find(".product-price").find("span"));

                let sum = quantitySum()
                $(".nav-desk").find("span").text(sum)
                calculate(node, quantity, price)
                calculateTotal()
            })

            function quantitySum() {
                let sum = 0
                $('.qnty').each(function () {
                    sum += parseFloat($(this).val())
                })
                return sum
            }

            $(window).on("beforeunload", function () {
                $.each($(".product-wrapper"), function (index, el) {
                    updateItems(el);
                })
            })



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

            function updateTotal(el) {

                let pTotal = parseFloat($(el).parent().find(".product-total").find("span").text())
                let subTotal = parseFloat($("#cart-subtotal span").text())
                let newPrice = subTotal - pTotal;
                $("#cart-subtotal span").text(newPrice)
                $("#cart-total span").text(newPrice + 80)
            }

            function updateItems(el) {
                let quantity = $(el).find(".product-quantity").find(".qnty").val()
                let itemID = $(el).find("input").attr("name")
                const data = { quantity: quantity, itemID: itemID }
                console.log(itemID);
                console.log(quantity);
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


            $(document).on("click", ".delete-confirmation button:first-child", function () {
                $(".check:checked").map(function (i, el) {
                    $(el).parent().slideUp(300, function () {
                        updateTotal(el)
                        removeItemFromDB(el)
                        $(el).parent().remove()
                    });
                })
                $(".delete-confirmation").removeClass("expand")
            })
            $(document).on("click", ".delete-confirmation button:last-child", function () {
                $(".delete-confirmation").removeClass("expand")
                $(".check:checked").map(function (i, el) {
                    $(el).prop("checked", false)
                })
            })


            $(".delete").click(function () {
                if ($(".check:checked").length <= 0) {
                    console.log("Select an item");
                    return
                }
                $(".delete-confirmation").addClass("expand")
            })
        })

    </script>
</body>

</html>