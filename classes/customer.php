<?php
class Customer extends DB
{
    private $ID;

    public function __construct($ID)
    {
        $this->ID = $ID;
    }

    public function getUser()
    {
        try {

            $stmt = $this->connect()->prepare("SELECT * FROM `customer` WHERE customerID = ?");
            $stmt->bindParam(1, $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }
}


?>