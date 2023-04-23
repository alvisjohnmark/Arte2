<?php include "../../global/user.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../css/style.css" rel="stylesheet" />
    <link href="../../css/products.css" rel="stylesheet">
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
                        <a href=<?php $userLoggedIn ? print "../profile.php" : print "../../forms/login.php" ?>><i
                                class="fa fa-heart" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "../profile.php" : print "../../forms/login.php" ?>><i
                                class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "../cart.php" : print "../../forms/login.php" ?>><i
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
                    <li><a href="../profile.php">Profile</a></li>
                    <li><a href="../wishlist.php">Wishlist</a></li>
                    <li>
                        <a href="../wishlist.php">About</a>
                    </li>
                    <li>
                        <a href="../forms/login.php">Contact</a>
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
                        <a href="../../index.php#products">
                            <li>Products</li>
                        </a>
                        <span>❯</span>
                        <li><b>Notebook</b></li>
                    </ul>
                    <div class="inner-outer-products">

                        <div class="card-container"></div>

                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../../global/js/animation.js"></script>
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

        $(document).ready(async function () {
            $.ajax({
                method: "GET",
                url: "../../server/item/getAll.php?kind=2",
                success: async function (response) {
                    let result = await JSON.parse(response)
                    result.data ? setElements(result) : console.log("No Items");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        });



        function setElements(params) {

            params.data.forEach(item => {
                let name = item["name"];
                let price = item["price"];
                let image = item["img"];
                let itemID = item["itemID"];
                let src = `../../assets/images/${image}`
                $("section .inner-outer-products .card-container").append(
                    $(`<a href="./notebooks/notebook.php?itemID=${itemID}"><div class="card">
                <div class="image-holder">
                    <img src=${src} loading="lazy">
                </div>
                <div class="detail">
                    <p>${name}</p>
                    <p></p>
                    <p>₱${price}.00</p>
                </div>
            </div></a>`));
            })


        }
    </script>
</body>

</html>