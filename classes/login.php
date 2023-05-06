<?php
/**
 * Summary of Login
 */
class Login extends DB
{

    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Summary of loginUser
     * @return int
     */
    public function loginUser(): int
    {
        $e = $this->email;
        $p = $this->password;
        $stmt = $this->connect()->query("SELECT `customerID` FROM `customer` WHERE customer.email = '$e' AND customer.password = '$p'");
        $result = $stmt->fetchColumn();
        if ($result == 0 || $result < 0 || $result == null) {
            $stmt = null;
            return 0; #login credentials invalid
            // header("location: ../forms/login.php");
            // exit();
        } else {
            $stmt = null;
            // header("location: ../index.php");
            // exit();
            return $result; #login credentials valid
        }
    }
}


?>