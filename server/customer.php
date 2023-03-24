<?php

if (isset($_GET)) {
    session_start();

    if (isset($_SESSION["customerID"])) {
        echo json_encode(["data" => true]);
    } else {
        echo json_encode(["data" => false]);

    }
} else {
    echo json_encode(["msg" => "Error"]);
    http_response_code(400);
    exit();
}
?>