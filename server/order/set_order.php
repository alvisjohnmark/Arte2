<?php if (isset($_POST['street'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/order.php";
    try {
        $address = $_POST["street"] . " " . $_POST["barangay"] . ", " . $_POST["c_m"] . ", " . $_POST["province"];
        $items = $_POST["items"];
        $cost = $_POST["cost"];
        $order = new Order(isset($_SESSION["customerID"]) ? $_SESSION["customerID"] : null, $items, $cost, $address);
        $msg = $order->setOrder();
        echo json_encode(["data" => $msg]);
        http_response_code(200);
    } catch (\Throwable $e) {
        echo json_encode(["msg" => $e]);
        http_response_code(400);
    }
} else {
    echo json_encode(["msg" => "Error"]);
    // http_response_code(400);
    exit();

}
?>