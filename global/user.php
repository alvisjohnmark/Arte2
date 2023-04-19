<?php session_start();

if (isset($_SESSION["customerID"])) {
    $userLoggedIn = true;
} else {
    $userLoggedIn = false;
}
?>