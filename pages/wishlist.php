<!-- <?php session_start(); ?> -->
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
    <title>Arte crafts</title>
</head>

<body>
    <header id="header">
        <div class="brand-name">
            <a href="../index.php">
                <span>Arte</span>
                <span>crafts</span>
            </a>
        </div>
        <navbar class="nav">
            <ul>
                <li><a href="./products/paper.php">About</a></li>
                <li><a href="#">Contact</a></li>
                <li>
                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="../forms/login.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                </li>
                <li>
                    <div class="tooltip">
                        <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span>0</span>
                        </a>
                        <span class="tooltiptext">No items in the cart</span>
                    </div>
                </li>
            </ul>
        </navbar>
    </header>

    <?php
    if (isset($_SESSION["customerID"])) { ?>
        <!--Do a while loop-->
        <section>
            <div class="inner-outer-products">
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
    <footer>
        <?php

        echo $_SESSION["customerID"] ?>
        asd
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(async function () {
            $.ajax({
                method: "GET",
                url: "../server/wishlist/get.php?customerID=null",
                success: async function (response) {
                    let result = await JSON.parse(response)
                    console.log(result.data);
                    result.data ? setElements(result) : console.log("No customer");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        });

        //do sql on refresh/close on the page

        // $(window).on('beforeunload', function () {
        //     let data = { itemID: 0 }
        //     console.log("asd");
        //     $.ajax({
        //         method: "POST",
        //         url: "../server/wishlist/add.php",
        //         data: data,
        //         success: function (response) {
        //             let result = JSON.parse(response)
        //             console.log(response);
        //         },
        //         error: function (xhr, status, error) {
        //             console.error(xhr, status, error);
        //         }
        //     })
        // });


        function setElements(params) {
            params.data.forEach(item => {
                let image = item["img"];
                let src = `../assets/images/${image}`
                $("section .inner-outer-products").append(
                    $(`<div class="product">
                        <div class="image-holder">
                            <a href="./paper/plain-recycled-paper.php">
                                <img src=${src}
                                    alt="Pic"></a>
                        </div>
                        <p id="PRP">Plain Recycled Paper</p>
                        <p>Php 50-70</p>
                        <span class="favorite">
                            <a><i class="fa fa-heart" aria-hidden="true"></i></a>
                        </span>
                    </div>`));
            })
        }

    </script>
</body>

</html>