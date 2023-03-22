<?php if (isset($_POST['submitform'])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    include "../classes/DB.php";
    include "../classes/signup.php";
    $signup = new SignUp($name, $email, $pwd);
    $signup->setUser();

} else {
    header("location: ../forms/signup.php");
    exit();

}
?>