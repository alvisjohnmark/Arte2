<?php if (isset($_POST['submitform'])) {
    session_start();
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    include "../classes/DB.php";
    include "../classes/signup.php";
    $signup = new SignUp($name, $email, $pwd);
    $result = $signup->setUser();
    if ($result) {
        $_SESSION["customerID"] = $result;
        header("location: ../index.php");
        exit();
    } else {
        header("location: ../forms/login.php");
        exit();
    }

} else {
    header("location: ../forms/signup.php");
    exit();

}
?>