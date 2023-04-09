<?php
class Item extends DB
{
    private $ID;
    public function __construct($ID)
    {
        $this->ID = $ID;
    }

    public function getItems()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM `item` WHERE kind = ?"); //use join
            $stmt->bindParam(1, $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function updateStock($quantity = null)
    {
        try {
            $stmt = $this->connect()->prepare("UPDATE `item` SET `stock`= stock - ? WHERE ?"); //use join
            $stmt->bindParam(1, $quantity, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }

    }

    public function getItem()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM `item` WHERE itemID = ?");
            $stmt->bindParam(1, $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            // return $stmt;
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }

    }
}
?>