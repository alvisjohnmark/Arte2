<?php
class Item extends DB
{
    private $ID;
    private $name;
    private $price;
    private $category;
    private $kind;
    private $stock;
    private $img;
    public function __construct($ID = null, $name = null, $price = null, $category = null, $kind = null, $stock = null, $img = null)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->kind = $kind;
        $this->stock = $stock;
        $this->img = $img;
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

    public function setItem()
    {
        try {
            $stmt = $this->connect()->prepare("INSERT INTO `item`( `name`, `price`, `category`, `kind`, `stock`, `img`) VALUES ('?','?','?','?','?','?')");
            $stmt->bindParam(1, $this->name, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->price, PDO::PARAM_INT);
            $stmt->bindParam(3, $this->category, PDO::PARAM_INT);
            $stmt->bindParam(4, $this->kind, PDO::PARAM_INT);
            $stmt->bindParam(5, $this->stock, PDO::PARAM_INT);
            $stmt->bindParam(6, $this->img, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return "Success";
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function deleteItem()
    {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM `item` WHERE itemID = ?");
            $stmt->bindParam(1, $this->ID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "Success";
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

}
?>