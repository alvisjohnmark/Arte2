<?php include "../../global/user.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/letter_writing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Document</title>
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
                    <li><a href="./products/paper.php">About</a></li>
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
    <div class="container">
        <div class="letter-writing-container">
            <div class="image-showcase-container">
                <div class="image-showcase">
                    <img src="../../assets/images/tancreamcursive.jpeg" alt="An envelope and a paper">
                </div>
            </div>
            <div class="selection">
                <h1>Pack and Shift as Gift</h1>
                <p>₱350.00</p>
                <p>Send us your thoughts and feelings towards someone, and we will write it and send it to them for you
                </p>


                <a href="../../forms/service_form.html"><button>Add To Cart</button></a>

            </div>
        </div>
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
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../../global/js/animation.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "../../server/cart/getItemsQnty.php",
            success: function (response) {
                let result = JSON.parse(response)
                console.log(result.data);
                if (result.data) {
                    console.log(result.data);
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
</script>

</html>