<?php

class DB
{
    public function connect()
    {
        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            // Create connection
            $conn = new PDO("mysql:host=$servername;dbname=arte", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }

}
?>