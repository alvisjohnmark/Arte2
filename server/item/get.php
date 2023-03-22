<?php

if (isset($_GET["itemID"])) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/item.php";


    try {
        $item = new Item($_GET["itemID"]);
        $msg = $item->getItem();
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