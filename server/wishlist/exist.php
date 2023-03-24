<?php

if (isset($_POST["itemID"])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/wishlist.php";

    if (isset($_SESSION["customerID"])) {
        try {
            $wishlist = new Wishlist($_SESSION["customerID"], $_POST["itemID"]);
            $msg = $wishlist->itemExist();
            echo json_encode(["data" => $msg]);
            http_response_code(200);
        } catch (\Throwable $th) {
            echo json_encode(["msg" => "Errory"]);
            // http_response_code(400);
        }
    } else {
        echo json_encode(["msg" => "No customer", "data" => null]);

    }
} else {
    echo json_encode(["msg" => "Error"]);
    http_response_code(400);
    exit();
}
?>