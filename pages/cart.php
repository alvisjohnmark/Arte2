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
                    <li><a href="./about.php">About Us</a></li>
                    <li>
                        <a href="./wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="./profile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
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
                    <li><a href="./about.php">About Us</a></li>
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

            <p style="margin: 1.4rem;"><b>My Shopping Cart</b></p>

            <div class="overflow" style="overflow-x:auto;">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </table>
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

            getItems(); //gets the items and render them to the page

            //gets the quantity of items in cart to be stored in cart quantity in header
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

                    $("table").append(
                        $(`<tr class="product" id=${itemID}>
                        <td class="product-item">
                            <div class="image">
                                <button class="remove">
                                    <span></span>
                                </button>

                                <img src=${src} alt="">
                            </div>
                            <p>${name}</p>
                        </td>
                        <td id="price">
                            <p style="min-width: 100px;">Php <span>${price}</span>.00</p>
                        </td>
                        <td class="quantity">
                            <div class="flex">
                                <button class="decrement" id="dec">
                                    <span></span>
                                </button>
                                <input class="qnty" value=${quantity} type="number" min=1 max=${stock} name=${itemID}>
                                <button class="increment" id="inc">
                                    <span></span>
                                </button>
                            </div>
                        </td>
                        <td id="total">
                            <p style="min-width: 100px;">Php <span>${price * quantity}</span>.00</p>
                        </td>
                    </tr>`));
                }) : $("section .totals").prepend("<div class='no-items-msg'><span>No items in your cart.</span></div>")
            calculateTotal()
        }

        //calculateTotal: Calculate the overall total of products including shipping
        function calculateTotal() {
            let total = 0
            $("table #total").each(function () {
                total += parseInt($(this).find("span").text())
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

            if (isNaN(quantity)) {
                $(e).text(0);
                return;
            }
            product = quantity * price;
            $(e).text(product);
        }

        //this gets the total quantity of all items
        //this function is called everytime there are changes in the inputs
        function quantitySum() {
            let sum = 0
            $('.qnty').each(function () {
                sum += parseFloat($(this).val())
            })
            isNaN(sum) ? sum = 0 : sum
            $(".nav-desk").find("span").text(sum)
        }

        function inputIncDecElement(element) {
            return $(element).parent().find("input")
        }

        $(document).on('click', "#inc", function () {
            let input = inputIncDecElement(this);
            let price = parseInt($(input).closest("tr").find("#price").find("span").text())
            let el = $(this).closest("tr").find("#total").find("span")
            if (input.attr("max") == input.val()) {
                input.val(1)
            } else {
                input.val(parseInt(input.val()) + 1)
            }
            calculate(el, parseInt(input.val()), price)
            inputActions()
        });

        $(document).on('click', "#dec", function () {
            let input = inputIncDecElement(this);
            let price = parseInt($(input).closest("tr").find("#price").find("span").text())
            let el = $(this).closest("tr").find("#total").find("span")
            if (parseInt(input.val()) == 1) {
                input.val(input.attr("max"))
            } else {
                input.val(parseInt(input.val()) - 1)
            }
            calculate(el, parseInt(input.val()), price);
            inputActions()
        });

        //this is for handling changes in the input.
        //to prevent multiple query every change in the input,
        //it calls a query every 2 seconds of inactivity from input
        let time_out_running = null;

        function inputActions() {
            calculateTotal()
            quantitySum()
            if (time_out_running) {
                clearTimeout(time_out_running);
                time_out_running = null;
            }
            if (!time_out_running) {
                time_out_running = setTimeout(function () {
                    $.each($("table .product"), function (index, el) {
                        updateItems(el);
                    })
                }, 2000)
            }
        }
        $(document).on('click', '#inc ,#dec', function () {
            inputActions()
        })

        $(document).on('input', ".qnty", function (e) {
            let quantity = parseInt($(e.target).val())
            let node = $(this).closest("tr").find("#total").find("span")
            let price = parseInt($(this).closest("tr").find("#price").find("span").text())
            if (quantity == 0) {
                ($(e.target).val(1)) //initialize to 1
            } else {
                if (quantity > $(this).attr("max")) {
                    let lastDigi = Math.floor(quantity / 10);
                    $(e.target).val(lastDigi)
                    return
                }
                ($(e.target).val(quantity))
            }
            calculate(node, quantity, price)
            inputActions()

        })

        $(document).on('click', '.remove', function () {
            let el = $(this).parents(".product");
            $(el).slideUp(300, function () {
                removeItemFromDB(el)
                $(el).remove()
                notify("Item Deleted!");
                quantitySum()
                calculateTotal()
            });
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

        function updateItems(el) {

            let quantity = parseInt($(el).find(".quantity").find("input").val())
            let itemID = parseInt($(el).find("input").attr("name"))
            isNaN(quantity) ? quantity = 0 : quantity
            console.log(quantity, itemID);
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

        //Checkout
        $(".checkout").click(function () {
            let items_list = []

            $(".product").each(function () {
                items_list.push(parseInt($(this).find("input").attr("name")));
            })

            //if there are no items in cart, can't checkout
            if (items_list.length <= 0) {
                notify("Please add items.")
                return;
            }

            let cartID = $("#cart-id").find("span").text().trim()
            let url = `./checkout.php?items=${items_list}&cartID=${cartID}`
            window.location = url
        })

    </script>
</body>

</html>