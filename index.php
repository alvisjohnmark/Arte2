<?php include "./global/user.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./css/index.css" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/logo.ico" />
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
                <a href="./index.php">
                    <span>Arte</span>
                    <span>crafts</span>
                </a>
            </div>
            <navbar class="nav-desk">
                <ul>
                    <li><a href="./pages/about.php">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "./pages/wishlist.php" : print "./forms/login.php" ?>><i
                                class="fa fa-heart" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "./pages/profile.php" : print "./forms/login.php" ?>><i
                                class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=<?php $userLoggedIn ? print "./pages/cart.php" : print "./forms/login.php" ?>><i
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
                    <li><a href="/pages/about.php">About</a></li>
                    <li><a href="./forms/login.php">Contact</a></li>
                </ul>
            </navbar>
        </div>
    </header>

    <main>
        <section class="main-content">
            <div class="container">
                <div class="hero-section">
                    <div class="content">
                        <h1>Locally-sourced Stationaries and Handcrafts</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor lobortis erat ut
                            scelerisque.
                            Nam blandit nisl nec purus tincidunt, accumsan fermentum metus facilisis. </p>
                        <button>Shop</button>
                    </div>
                </div>
            </div>
        </section>
        <!--PRODUCTS SECTION-->
        <section class="products" id="products">
            <div class="container">
                <h2>OUR PRODUCTS</h2>
                <div class="items">
                    <div class="item">
                        <a href="./pages/products/papers.php">
                            <div class="image">
                                <img src="./assets/images/PRP.png" alt="" />
                            </div>
                        </a>
                        <div class="text">
                            <p>Paper</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="./pages/products/notebooks.php">
                            <div class="image">

                                <img src="./assets/images/Personalised-Journal-Notebook-Custom-Name-Journal-Custom-Etsy-Copy.png"
                                    alt="" />
                            </div>
                        </a>
                        <div class="text">
                            <p>Recycled Notebooks</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="./pages/products/cases.php">
                            <div class="image">
                                <img src="./assets/images/pencil-case_-cottagecore_-pencil-pouch_-pencil-case-aesthetic_-cottage-core_-estuches-lapices-tela_-.png"
                                    alt="" />
                            </div>
                        </a>
                        <div class="text">
                            <p>Canvas Pencil Case and Pouches</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="./pages/products/pens.php">
                            <div class="image">
                                <img src="./assets/images/Pretty-Stationery-Items.png" alt="" />
                            </div>
                        </a>
                        <div class="text">
                            <p>Stationary and Calligraphy Pens</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="sticky"><button><a href="./pages/admin.php"><i class="fa fa-home"></i></a></button></div>
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
    <!-- <script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./global/js/animation.js">
    </script>
    <script>
    $(document).ready(function() {
        $.ajax({
            method: "GET",
            url: "./server/cart/getItemsQnty.php",
            success: function(response) {
                let result = JSON.parse(response)
                console.log(result.data);
                if (result.data) {
                    console.log(result.data);
                    $(".nav-desk").find("span").text(result.data)
                } else {
                    console.log("No User");
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        })
    });
    </script>
</body>

</html>