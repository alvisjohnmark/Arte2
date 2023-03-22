<?php if (isset($_POST['itemID'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/order.php";
    try {
        $quantity = $_POST["quantity"];
        $ID = $_POST["itemID"];
        $order = new Order(isset($_SESSION["customerID"]) ? $_SESSION["customerID"] : null, $ID, $quantity);
        $msg = $order->setItemToOrder();
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