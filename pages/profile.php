<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/items.css" rel="stylesheet" />
    <link href="../css/profile.css" rel="stylesheet" />
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
            <div class="profile-wrapper">
                <div class="profile">
                    <div class="profile-image">
                        <img src="../assets/images/Pretty-Stationery-Items.png" alt="">
                    </div>
                    <div class="profile-details">
                        <p class="name">Jonathan</p>
                        <p class="address">Brgy. 29 Pasngal, Bacarra, Ilocos Norte</p>
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
    <div class="order-items-wrapper-overlay"></div>
    <div class="order-items-wrapper">
        <i style="font-size: 1.5rem;" class="fa fa-times" aria-hidden="true"></i>
        <h2>Items</h2>
        <div class="order-items">
            <div class="items">

            </div>
        </div>
        <div class="total fixed">
            <span> <b>Total:</b>
                <span>
                    23123
                </span>
                PHP
            </span>
            <button>Cancel Order</button>
        </div>
    </div>

    <footer>
        asd
        <?php
        echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

        if (isset($_SESSION["customerID"])) {
            echo $_SESSION["customerID"];
        } else {
            echo "Po";
        }

        ?>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
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
        })


        function setItems(params) {
            $(".order-items .items").empty() //remove the existing child elements
            params.forEach(item => {
                $(".order-items .items").append(`<div class="item">
                    <span><img src="../assets/images/PRP.png" alt=""></span>
                    <div>
                        <p>${item["name"]}</p>
                        <p>Paper</p>
                    </div>
                    <span>x</span>
                    <span>${item["quantity"]}</span>
                </div>`)
                $(".total").find("span").find("span").text(item["cost"])
            })

        }

        $(".fa-times").click(function () {
            $(".order-items-wrapper").removeClass("open")
            $(".order-items-wrapper-overlay").removeClass("open")
        })

        $(document).on("click", ".details", function () {
            $(".order-items-wrapper").addClass("open");
            $(".order-items-wrapper-overlay").addClass("open");
            let orderID = parseInt($(this).parent().attr("id"));
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

    </script>

</body>

</html>