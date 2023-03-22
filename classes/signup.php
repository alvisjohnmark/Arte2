<?php
class SignUp extends DB
{
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    private function checkUser()
    {
        $e = $this->email;
        $stmt = $this->connect()->query("SELECT email FROM `customer`WHERE email = '$e'");
        $result = $stmt->fetchColumn();
        if ($result == 0 || $result < 0 || $result == null) {
            $stmt = null;
            return false; #user email does not exist
        } else {
            $stmt = null;
            return true; #user email already exists
        }
    }
    public function setUser(): bool
    {
        if ($this->checkUser() == true) {
            header("location: ../forms/signup.php");
            // return false;
            exit();
        } else {
            $stmt = $this->connect()->prepare("INSERT INTO `customer` (`name`, `email`, `password`) VALUES (?,?,?)");
            $stmt->bindParam(1, $this->name, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->email, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->password, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt = null;
                // return true;
                header("location: ../index.php"); #success
                exit();
            } else {
                $stmt = null;
                // return false;
                header("location: ../forms/signup.php"); #failure
                exit();
            }
        }
    }

}


?>