<?php
$valid_extensions = array('jpeg', 'jpg', 'png');
$path = '../../assets/images/';
if (isset($_POST['itemID'])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/item.php";
    try {

        $post_image = null;
        $img = $_FILES["image"]["name"];
        $tmp = $_FILES["image"]["tmp_name"];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $final_image = rand(1000, 1000000) . $img;
        if (in_array($ext, $valid_extensions)) {
            $path = $path . strtolower($final_image);
            if (move_uploaded_file($tmp, $path)) {
                $post_image = $final_image;
            }
        }
        $post_ID = $_POST['itemID'];
        $post_name = $_POST['name'];
        $post_price = $_POST['price'];
        $post_kind = $_POST['kind'];
        $post_stock = $_POST['stock'];
        $post_description = $_POST['description'];
        $item = new Item($post_ID, $post_name, $post_price, 1, $post_kind, $post_stock, $post_image, $post_description);
        $msg = $item->updateItem();
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