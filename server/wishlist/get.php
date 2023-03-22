<?php

if (isset($_GET["customerID"])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/wishlist.php";

    if (isset($_SESSION["customerID"])) {
        try {
            $order = new Wishlist($_SESSION["customerID"], null);
            $msg = $order->getWishlist();
            echo json_encode(["data" => $msg]);
            http_response_code(200);
        } catch (\Throwable $th) {
            echo json_encode(["msg" => "Errory"]);
            // http_response_code(400);
        }
    } else {
        print_r($_SESSION);
        echo $_SESSION["customerID"];
        echo json_encode(["msg" => "No customer", "data" => null]);

    }
} else {
    echo json_encode(["msg" => "Error"]);
    http_response_code(400);
    exit();
}
?>