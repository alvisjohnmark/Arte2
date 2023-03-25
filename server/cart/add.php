<?php if (isset($_POST['itemID'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/cart.php";
    try {
        $quantity = $_POST["quantity"];
        $ID = $_POST["itemID"];
        $cart = new Cart(isset($_SESSION["customerID"]) ? $_SESSION["customerID"] : null, $ID, $quantity);
        $msg = $cart->setItemToCart();
        echo json_encode(["data" => $msg]);
        http_response_code(200);
    } catch (\Throwable $e) {
        echo json_encode(["msg" => $e]);
        // http_response_code(400);
    }
} else {
    echo json_encode(["msg" => "Error"]);
    // http_response_code(400);
    exit();

}
?>