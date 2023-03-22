<?php if (isset($_POST['submitform'])) {

    session_start();
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    include "../classes/DB.php";
    include "../classes/login.php";
    $login = new Login($email, $pwd);
    $result = $login->loginUser();
    if ($result) {
        $_SESSION["customerID"] = $result;
        header("location: ../index.php");
    } else {
        header("location: ../forms/login.php");

    }

} else {
    header("location: ../forms/login.php");
    exit();

}
?>