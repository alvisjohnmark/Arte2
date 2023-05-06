<?php

if (isset($_GET["itemID"])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/item.php";


    try {
        $get_itemID = $_GET["itemID"];
        $item = new Item();
        $msg = $item->getItem($get_itemID);
        echo json_encode(["data" => $msg]);
        http_response_code(200);
    } catch (\Throwable $th) {
        echo json_encode(["msg" => "Errory"]);
        // http_response_code(400);
    }
} else {
    echo json_encode(["msg" => "Error"]);
    http_response_code(400);
    exit();
}
?>