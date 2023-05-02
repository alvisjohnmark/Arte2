<?php include "../global/user.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/index.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/products.css" rel="stylesheet" />
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
    <?php
    if (isset($_SESSION["customerID"])) { ?>
        <!--Do a while loop-->
        <section>
            <div class="container">
                <div class="inner-outer-products">
                    <div class="card-container"></div>
                </div>
            </div>
        </section>
        <?php
    } else { ?>
        <p>
            You haven't added any to your wishlist
        <p>
            <?php
    }
    ?>
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
        $(document).ready(function () {
            $.ajax({
                method: "GET",
                url: "../server/wishlist/get.php?customerID=null",
                success: function (response) {
                    let result = JSON.parse(response)
                    console.log(result.data);
                    result.data ? setElements(result) : console.log("No customer");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        });


        $(document).on('click', "#card", function (e) {
            // console.log(e.currentTarget);
            if ($(e.target).is("#heart")) {
                const dataObj = ($(this).attr("data-item-id"));
                data = { itemID: dataObj }
                $(e.currentTarget).fadeOut(300)
                $.ajax({
                    method: "POST",
                    url: "../server/wishlist/delete.php",
                    data: data,
                    success: function (response) {
                        let result = response
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                    }
                })
            } else {
                let ID = $(this).attr("data-item-id")
                window.location.href = `http://localhost/ARTE/products/papers/paper.php?itemID=${ID}`
            }
        });


        function setElements(params) {
            params.data.length > 0 ?
                params.data.forEach(item => {
                    let image = item["img"];
                    let name = item["name"];
                    let price = item["price"];
                    let itemID = item["itemID"]
                    let kind = item["kind"]
                    let src = `../assets/images/${image}`
                    $("section .inner-outer-products .card-container").append(
                        $(`<div id="card" class="card" data-item-id="${itemID}">
                <div class="image-holder">
                    <img src=${src} loading="lazy">
                    <span><i id="heart" class="fa fa-heart" aria-hidden="true"></i></span>
                </div>
                <div class="detail">
                    <p>${name}</p>
                    <p>${kind}</p>
                    <p>₱${price}.00</p>
                </div>
            </div>`));
                }) : $("section .inner-outer-products .card-container").append("<div>You haven't added in your wishlist.</div>")
        }

        // $(document).on("click",, function () {

        // })

    </script>
</body>

</html>