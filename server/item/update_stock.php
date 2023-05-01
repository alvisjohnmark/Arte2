<?php if (isset($_POST['itemID'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/item.php";
    try {
        $post_itemID = $_POST['itemID'];
        $post_quantity = $_POST['quantity'];
        $item = new Item();
        $msg = $item->update_stock($post_itemID, $post_quantity);
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