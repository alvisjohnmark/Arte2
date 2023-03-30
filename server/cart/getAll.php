<?php if (isset($_GET)) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/cart.php";
    try {
        $cart = new Cart(isset($_SESSION["customerID"]) ? $_SESSION["customerID"] : null);
        $msg = $cart->getItems();
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