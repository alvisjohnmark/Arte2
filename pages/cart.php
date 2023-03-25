<?php echo ""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="../css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Arte crafts</title>
</head>

<body>
    <header id="header">
        <div class="brand-name">
            <a href="../index.₱">
                <span>Arte</span>
                <span>crafts</span>
            </a>
        </div>
        <navbar class="nav">
            <ul>
                <li><a href="./products/paper.html">Home</a></li>
                <li><a href="./products/paper.html">About</a></li>
                <li><a href="#">Contact</a></li>
                <li>
                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span>0</span>
                    </a>
                </li>
            </ul>
        </navbar>
    </header>

    <section>
        <div class="container">

            <h1>Shopping Cart</h1>

            <div class="products">
                <div class="line"></div>
                <div class="product-wrapper">
                    <input type="checkbox" id="check">
                    <label for="check">
                        <div class="product">
                            <div class="product-image">
                                <img src="../assets/images/Dark Academia Stationary Kit Letter Writing Dark Academia - Etsy - Copy.png"
                                    alt="">
                            </div>
                            <div class="product-title">
                                <p>Plain Recycled Paper</p>
                            </div>
                            <div class="product-price">
                                <p>₱50.00</p>
                            </div>
                            <div class="product-quantity">
                                <input id="qnty" type="number" min="1" value="1">
                            </div>
                            <div class="product-total">
                                <p>₱<span>100</span>.00</p>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="line"></div>
                <div class="product-wrapper">
                    <input type="checkbox" id="check1">
                    <label for="check1">
                        <div class="product">
                            <div class="product-image">
                                <img src="../assets/images/Dark Academia Stationary Kit Letter Writing Dark Academia - Etsy - Copy.png"
                                    alt="">
                            </div>
                            <div class="product-title">
                                <p>Plain Recycled Paper</p>
                            </div>
                            <div class="product-price">
                                <p>₱50.00</p>
                            </div>
                            <div class="product-quantity">
                                <input id="qnty" type="number" min="1" value="1">
                            </div>
                            <div class="product-total">
                                <p>₱<span>100</span>.00</p>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="line"></div>
                <div class="totals">
                    <div class="totals-item">
                        <label>Subtotal</label>
                        <div class="totals-value" id="cart-subtotal">₱<span>100</span></div>
                    </div>
                    <div class="totals-item">
                        <label>Shipping</label>
                        <div class="totals-value" id="cart-shipping">₱15.00</div>
                    </div>
                    <div class="totals-item totals-item-total">
                        <label>Grand Total</label>
                        <div class="totals-value" id="cart-total">₱<span>100</span></div>
                    </div>
                </div>
                <button class="checkout">Checkout</button>
            </div>
    </section>

    <footer>
        asd
    </footer>
    <!-- <script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script> -->
    <!-- <script src="./js/animation.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on("click", ".fa-shopping-cart", function () {
            console.log("Hey");
        })

        function getItems() {
            $.ajax({
                method: "GET",
                url: "../server/order/getAll.php",
                success: async function (response) {
                    let result = await JSON.parse(response)
                    console.log(result.data);
                    result.data ? console.log(result.data) : console.log("No customer");
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        }

        $(document).ready(function () {

            getItems();

            let s = Number($('#qnty').val())

            function calculate(e, quantity) {
                let price = 50 //change this later
                product = quantity * price;
                $(e).text(product);
            }

            function calculateTotal() {
                let subTotal = 0;

                ($(".product-total p span").each(function (index) {
                    subTotal += parseFloat($(this).text());
                }));
                console.log("asd");
                $("#cart-subtotal span").text(subTotal)
                $("#cart-total span").text(subTotal + 15)
            }

            $(document).on('input', "#qnty", function (e) {
                let quantity = Number($(e.target).val())
                let node = ($(e.target).parent().parent().children(".product-total").children().children("span"))
                calculate(node, quantity)
                calculateTotal()
            })


        })

    </script>
</body>

</html>