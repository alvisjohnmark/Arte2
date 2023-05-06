<?php if (isset($_POST['itemID'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/wishlist.php";
    try {
        $ID = $_POST["itemID"];
        $wishlist = new Wishlist($_SESSION["customerID"], $ID);
        $msg = $wishlist->setToWishlist();
        echo json_encode(["data" => $msg]);
        http_response_code(200);
    } catch (\Throwable $th) {
        echo json_encode(["msg" => "Errory"]);
    }
} else {
    return json_encode(["msg" => "itemID missing"]);
}
?>