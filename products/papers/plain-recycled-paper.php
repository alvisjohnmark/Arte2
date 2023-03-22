<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../css/style.css" rel="stylesheet" />
    <link href="../../css/item_showcase.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>Arte crafts</title>
</head>

<body>
    <header id="header">
        <div class="brand-name">
            <a href="../../index.php">
                <span>Arte</span>
                <span>crafts</span>
            </a>
        </div>
        <navbar class="nav">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li>
                    <a href="../../pages/wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="../../forms/login.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
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
    <main>
        <section class="paper">
            <div class="container">
                <div class="outer-paper-products">
                    <ul>
                        <a href="../../index.php#products">
                            <li>Products</li>
                        </a>
                        <span>❯</span>
                        <a href="../paper.php">
                            <li>Paper</li>
                        </a>
                        <span>❯</span>
                        <li>Plain Recycled Paper</li>
                    </ul>
                    <div class="inner-outer-products">
                        <div class="item">
                            <div class="item-wrapper">
                                <div class="item-image">
                                    <img
                                        src="../../assets/images/HANDMADE COTTON RAG DECKLE EDGE PAPER _ HEMP PAPER _ RECYCLED PAPER.png">

                                </div>
                                <div class="item-detail">
                                    <p>Plain Recycled Paper</p>
                                    <p>Php 50.00 - 60.00</p>
                                    <p>Each pack contains <b>6</b> pieces.</p>

                                    <table>
                                        <tr>
                                            <th>Sizes</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                        </tr>
                                        <tr>
                                            <th>A6</th>
                                            <th>10</th>
                                            <th>50</th>
                                        </tr>
                                        <tr>
                                            <th>A5</th>
                                            <th>10</th>
                                            <th>60</th>
                                        </tr>
                                        <tr>
                                            <th>A4</th>
                                            <th>12</th>
                                            <th>70</th>
                                        </tr>
                                    </table>
                                    <div>
                                        <div class="rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <button class="btn">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <footer></footer>
    <script src="../js/animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>

    // $(document).ready(function () {
    //   $(".btn").click(function () {
    //     let data = { name: "PRP", quantity: 30, itemID: 1 }

    //     $.ajax({
    //       method: "POST",
    //       url: "../server/addorder.php",
    //       data: data,
    //       success: function (response) {
    //         let result = JSON.parse(response)
    //         console.log(result);
    //       },
    //       error: function (xhr, status, error) {
    //         console.error(xhr, status, error);
    //       }
    //     })
    //   });
    // });

    </script>
</body>

</html>