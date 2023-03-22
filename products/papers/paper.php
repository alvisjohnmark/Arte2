<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../css/style.css" rel="stylesheet" />
    <link href="../../css/product_showcase.css" rel="stylesheet">
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
    <main>
        <section class="paper">
            <div class="container">
                <div class="outer-paper-products">
                    <ul>
                        <a href="../../index.php#products">
                            <li>Products</li>
                        </a>
                        <span>❯</span>
                        <a href="../papers.php">
                            <li>Paper</li>
                        </a>
                        <span>❯</span>
                        <li id="name"></li>
                    </ul>
                    <div class="item">
                        <?php

                        try {
                            // $DB = new DB();
                            // $conn = $DB->connect();
                            // $stmt = $conn->query("SELECT * FROM `item` WHERE itemID = 1");
                            // $stmt->bindParam(1, 1, PDO::PARAM_INT);
                        
                            // while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                            //     echo $row['name'] . '<br>';
                            // }
                            // $data = $stmt->fetch(PDO::FETCH_ASSOC);
                            // $ID = $_GET["itemID"];
                            // $item = new Item($ID);
                            // $msg = $item->getItem();
                            // $data = json_encode($msg);
                            // $name = $msg["name"];
                            // $price = $msg["price"];
                            // $img = $msg["img"];
                            // ?>
                            <!-- <div class="item-wrapper">
                                <div class="item-image">
                                    <img src="<?php echo '../../assets/images/' . $img ?>">
                                </div>
                                <div class="item-detail">
                                    <p>
                                        <?php echo $name ?>
                                    </p>
                                    <p>₱
                                        <?php echo $price ?>.00
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore
                                        et dolore magna aliqua.</p>
                                    <div class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i>
                                    </div>
                                    <div class="lower">
                                        <div class="quantity-wrapper">
                                            <p>Each pack contains <b>6</b> pieces.</p>
                                            <form action="">
                                                <div class="quantity">
                                                    <label for="qnty">Quantity</label>
                                                    <input type="number" id="qnty" name="qnty" value="0" min="1" max="1000">
                                                    <div class="inc-dec">
                                                        <button id="inc"><i class="fa fa-caret-up"
                                                                aria-hidden="true"></i></button>
                                                        <button id="dec"><i class="fa fa-caret-down"
                                                                aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                        </div>
                                        <input type="submit" value="submit">
                                        <button class="add-to-cart">Add to cart</button>
                                        </form>

                                    </div>
                                </div>
                            </div> -->
                            <!-- <?php
                        } catch (\Throwable $th) {
                            echo json_encode(["msg" => "Errory"]);

                        } ?> -->
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <footer></footer>
    <script src="../../js/animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            let value = params.itemID; // "some_value"
            $.ajax({
                method: "GET",
                url: `../../server/item/get.php?itemID=${value}`,
                success: async function (response) {
                    let result = await JSON.parse(response)
                    result.data ? setElements(result.data) : console.log("No Item");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })

            function setElements(item) {
                let name = item["name"];
                let price = item["price"];
                let image = item["img"];
                let stock = item["stock"];
                let src = `../../assets/images/${image}`
                $("section .item").append(

                    $(`<div class="item-wrapper">
              <div class="item-image">
                <img src=${src}>
              </div>
              <div class="item-detail">
                <p>${name}</p>
                <p>₱${price}.00</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.</p>
                <div class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i>
                </div>
                <div class="lower">
                  <div class="quantity-wrapper">
                    <p>Stocks remaining: <b>${stock}</b>.</p>
                    <p>Each pack contains <b>6</b> pieces.</p>
                    <div class="quantity">
                      <label for="qnty">Quantity</label>
                      <input type="number" id="qnty" name="qnty" value="0" min="1" max="1000">
                      <div class="inc-dec">
                        <button id="inc"><i class="fa fa-caret-up" aria-hidden="true"></i></button>
                        <button id="dec"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>
                  <button id="cart" class="add-to-cart">Add to cart</button>

                </div>
              </div>
            </div>`
                    ));
                $(".outer-paper-products #name").append(
                    $(`<b>${name}</b>`)
                )

                $(document).on('click', "#inc", function () {
                    let cur = Number($("#qnty").val())
                    if (cur == item["stock"] || cur === item["stock"]) {
                        return
                    }

                    $("#qnty").val(cur + 1)

                });
                $(document).on('click', "#dec", function () {
                    let cur = $("#qnty").val()
                    if (cur == 0 || cur === 0) {
                        return
                    } else {
                        $("#qnty").val(cur - 1)
                    }
                });
            }

            //ADD TO CART 
            $(document).on('click', "#cart", function (i) {
                let qnty = $("#qnty").val()
                //itemID is very importanting
                console.log(qnty);
                let data = { quantity: qnty, itemID: value }
                $.ajax({
                    method: "POST",
                    url: "../../server/order/add.php",
                    data: data,
                    success: function (response) {
                        let result = JSON.parse(response)
                        console.log(result);
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                    }
                })
            });

            $(document).on('click', ".fa-heart", function () {
                if ($(this).hasClass("beat")) {
                    $(this).removeClass("beat");
                } else {
                    $(this).addClass("beat");
                }
            });

            $(window).on('beforeunload', function () {
                let data = { itemID: 0 }
                console.log("asd");
                $.ajax({
                    method: "POST",
                    url: "../server/wishlist/add.php",
                    data: data,
                    success: function (response) {
                        let result = JSON.parse(response)
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                    }
                })
            });
        });

    </script>
</body>

</html>