<?php
/**
 * Summary of Customer
 */
class Customer extends DB
{
    private $ID;

    /**
     * Summary of __construct
     * @param int $ID
     */
    public function __construct($ID)
    {
        $this->ID = $ID;
    }

    /**
     * Summary of getUser
     * @return array|string
     */
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