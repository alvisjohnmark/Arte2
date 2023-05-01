<?php session_start();
$userLoggedIn = isset($_SESSION["customerID"]) ? true : false;
?>