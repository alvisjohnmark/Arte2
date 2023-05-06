<?php include "../global/user.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/profile.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/checkout.css">
    <link href="../css/items.css" rel="stylesheet" />
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
                </ul>
            </navbar>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="profile-wrapper">
                <div class="profile">
                    <div class="profile-image">
                        <img src="../assets/images/Pretty-Stationery-Items.png" alt="">
                    </div>
                    <div class="profile-details">
                        <p class="name"></p>
                        <p class="address"></p>
                        <button id="logout">Logout</button>
                    </div>
                </div>
                <div class="my-orders">
                    <p>My Orders</p>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>Order ID</th>
                                <th>Date placed</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <div class="order-summary-overlay"></div>
    <div class="order-summary">
        <i style="font-size: 1.5rem;" class="fa fa-times" aria-hidden="true"></i>
        <div class="summary">
            <p>Order Summary</p>
            <ul>
            </ul>

            <hr>
            <p style="font-size: 1rem;" id="address"></p>
            <hr>
            <div class="sub total">
                <p>Subtotal</p>
                <p>₱<span></span>.00</p>
            </div>
            <div class="shipping total">
                <p>Shipping</p>
                <p>₱<span></span>.00</p>
            </div>
            <hr>
            <div class="order total">
                <p>Order Total</p>
                <p>₱<span></span>.00</p>
            </div>
        </div>
        <form action="" method="post">
            <input type="button" value="Cancel Order" id="cancel-order-button">
        </form>
    </div>

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

        function notify(msg) {
            let div = document.createElement("div");
            div.innerHTML = msg
            div.classList.add("notify")
            $("body").prepend(div);

            setTimeout(function () {
                if ($('.notify').length > 0) {
                    div.remove();
                }
            }, 2000)
        }


        $(document).ready(function () {

            if (sessionStorage.getItem("cancel") == "True") {
                notify("Order Cancelled");
            }
            sessionStorage.setItem("cancel", "False")
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

            $.ajax({
                method: "GET",
                url: "../server/customer/get.php",
                success: function (response) {
                    let result = JSON.parse(response)
                    if (result.data) {
                        setUser(result.data)

                    } else {
                        console.log("No User");
                    }

                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })


            $.ajax({
                method: "GET",
                url: "../server/order/get_orders.php",
                success: function (response) {
                    let result = JSON.parse(response)
                    if (result.data) {
                        setItem(result.data)
                        // console.log(result.data)

                    } else {
                        console.log("No User");
                    }

                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })

        })

        function setUser(user) {
            $('.profile-details p:first-child').text(user[0]['name'])
            $('.profile-details p:nth-child(2').text(user[0]['email'])
        }

        function setItem(items) {
            items.forEach(item => {
                $(".table-container table").append($(`<tr id=${item["orderID"]}>
                            <td>Order ${item["orderID"]} </td>
                            <td>${item["time_placed"]}</td>
                            <td>${item["status"]}</td>
                            <td class="details">Details</td>
                        </tr>`))
            });
        }

        function setItems(params) {
            $(".order-summary ul").empty() //remove the existing child elements
            console.log(params);
            // $(".order-summary ul").prop("id", "")
            params.forEach(item => {
                $(".order-summary ul").append(`<li>
                    <img src=../assets/images/${item["img"]} alt="">
                    <div>
                        <p>${item["name"]}</p>
                        <p>Qnty: <span>${item["quantity"]}</span></p>
                        <p>₱<span>${item["price"] * item["quantity"]} .00</span></p>
                    </div>
                </li>`)

            })
            $("#address").text(params[0]["address"])
            $(".sub").find("p:nth-child(2) span").text(params[0]["cost"] - 80)
            $(".shipping").find("p:nth-child(2) span").text(80)
            $(".order").find("p:nth-child(2) span").text(params[0]["cost"])

        }

        $(".fa-times").click(function () {
            $(".order-summary").removeClass("open")
            $(".order-summary-overlay").removeClass("open")
        })

        $(document).on("click", ".details", function () {
            $(".order-summary").addClass("open");
            $(".order-summary-overlay").addClass("open");
            let orderID = parseInt($(this).parent().attr("id"));
            setOrderID(orderID)
            data = { orderID: orderID }
            $.ajax({
                method: "POST",
                url: "../server/order/get_order_items.php",
                data: data,
                success: function (response) {
                    let result = JSON.parse(response)
                    if (result.data) {
                        console.log(result.data);

                        setItems(result.data)

                    } else {
                        console.log("No User");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        })

        let orderID = 0

        function setOrderID(order) {
            orderID = order
        }

        $("#cancel-order-button").click(function () {
            data = { "orderID": orderID }
            $.ajax({
                method: "POST",
                url: "../server/order/cancel_order.php",
                data: data,
                success: function (response) {
                    let result = JSON.parse(response)
                    if (result.data) {
                        console.log(result.data);
                        sessionStorage.setItem("cancel", "True")
                        location.reload()

                    } else {
                        console.log("No User");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        })

        $("#logout").click(function () {
            window.location = '../global/logout.php'
        })


    </script>

</body>

</html>