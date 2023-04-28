<?php

if (isset($_GET)) {
    session_start();
    include "../../classes/DB.php";
    include "../../classes/customer.php";


    try {
        $customer = new Customer(($_SESSION["customerID"]) ? $_SESSION["customerID"] : null);
        $msg = $customer->getUser();
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