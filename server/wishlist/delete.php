<?php if (isset($_POST['item'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/wishlist.php";

    //try using array for items and iterate through each item in the list
    try {
        $ID = $_POST["itemID"];
        $order = new Wishlist($_SESSION["customerID"], $ID);
        $msg = $order->deleteFromWishlist();
        echo json_encode(["data" => $msg]);
        http_response_code(200);
    } catch (\Throwable $th) {
        echo json_encode(["msg" => "Errory"]);
        // http_response_code(400);
    }
} else {
    echo json_encode(["msg" => "Error"]);
    // http_response_code(400);
    exit();

}
?>