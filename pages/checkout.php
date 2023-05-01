<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/checkout.css">
    <title>Arte crafts</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="checkout-wrapper">
                <div class="checkout-container">
                    <form>
                        <div class="order-details">
                            <div class="shipping-address">
                                <p>Shipping info</p>
                                <input type="text" placeholder="Street" name="street" id="street" required>
                                <br>
                                <input type="text" placeholder="Barangay" name="barangay" id="barangay" required>
                                <br>
                                <input type="text" placeholder="City/Municipality" name="c_m" id="c_m" required>
                                <br>
                                <input type="text" placeholder="Province" name="province" id="province" required>
                                <span class="note">Your order will be delivered within 7 working days (May take longer
                                    for
                                    some
                                    occasions).
                                </span>
                                <br>
                            </div>
                            <hr>
                            <div class="payment">
                                <p>Payment Method</p>
                                <input type="radio" id="cod" name="payment-method" value="cod" checked="true">
                                <label for="cod">Cash On Delivery</label><br>

                                <input type="radio" id="card" name="payment-method" value="card">
                                <label for="card">Credit/Debit Card</label><br>

                                <div class="card">
                                    <input type="text" placeholder="Name on Card">
                                    <br>
                                    <input type="text" placeholder="Card Number">
                                    <br>
                                    <input type="date" placeholder="Expiration Date">
                                    <input type="text" placeholder="Security Code (CVV)">
                                </div>
                            </div>
                            <input type="submit" value="Complete Purchase">
                            <input type="button" value="Cancel" id="cancel-purchase-btn">
                        </div>
                    </form>
                    <div class="order-summary">
                        <div class="summary">
                            <p>Order Summary</p>
                            <ul>
                            </ul>

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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../global/js/animation.js"></script>
    <script>

        $(document).ready(function () {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            //get items in the url
            let list = params.items.split(",").map(function (str) { return parseInt(str) })
            console.log(list);
            getItems();

            function getItems() {
                $.ajax({
                    method: "GET",
                    url: "../server/cart/getAll.php",
                    success: function (response) {
                        //filter out items not in the list
                        let result = JSON.parse(response)
                        let new_list = result.data.filter(function (item) {
                            return list.includes(item["itemID"])
                        })
                        setOrderSummary(new_list)
                        // store the items in the sessionStorage
                        // retrieve when user checks out
                        sessionStorage.setItem("items", JSON.stringify(new_list));
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                    }
                })
            }

            function setOrderSummary(items) {
                let subtotal = 0;
                items.map(function (item) {
                    $(".summary ul").append(`<li>
                <img src=../assets/images/${item["img"]} alt="">
                                        <div>
                                            <p>${item["name"]}</p>
                                            <p>Qnty: <span>${item["quantity"]}</span></p>
                                            <p>₱<span>${item["quantity"] * item["price"]}</span>.00</p>
                                            </div>
                                            </li>`)
                    subtotal += item["quantity"] * item["price"]
                })
                $(".summary .sub p:nth-child(2) span").text(subtotal)
                $(".summary .shipping p:nth-child(2) span").text(80)
                $(".summary .order p:nth-child(2) span").text(subtotal + 80)
            }

            $("input[name=payment-method]").click(function () {
                if ($('input[id="card"]').is(":checked")) {
                    $(".card").css("visibility", "visible")
                    $(".card").find("input").prop("required", true)
                    console.log("On");
                } else {
                    $(".card").css("visibility", "hidden")
                    $(".card").find("input").prop("required", false)
                    console.log("OFF");

                }
            })

            function updateStock() {
                const items = JSON.parse(sessionStorage.getItem("items"));
                console.log(items);
                items.map((function (item) {
                    let data = {}
                    data.itemID = item.itemID
                    data.quantity = item.quantity
                    console.log(data);

                    $.ajax({
                        method: "POST",
                        url: "../server/item/update_stock.php",
                        data: data,
                        success: function (response) {
                            console.log(response);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr, status, error);
                        }
                    })
                }))
            }

            $("form").submit(function (e) {
                e.preventDefault();

                let cost = parseInt($(".summary .order p:nth-child(2) span").text())
                let street = $("#street").val();
                let barangay = $("#barangay").val();
                let c = $("#c_m").val();
                let province = $("#province").val();
                let data = { "street": street, "barangay": barangay, "c_m": c, "province": province, "cost": cost, "items": list }

                $.ajax({
                    method: "POST",
                    url: "../server/order/set_order.php",
                    data: data,
                    success: function (response) {
                        updateStock()
                        window.history.back()

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                    }
                })
            })

            $("#cancel-purchase-btn").click(function () {
                $(".card").css("visibility", "hidden")
                window.history.back()
            })
        })
    </script>
</body>

</html>