<?php
class Wishlist extends DB
{
    private $customerID;
    private $itemID;
    public function __construct($customerID, $itemID)
    {
        $this->customerID = $customerID;
        $this->itemID = $itemID;
    }

    public function setToWishlist()
    {
        if ($this->itemExist())
            return;
        try {
            $stmt = $this->connect()->prepare("INSERT INTO `wishlist`(`customerID`, `itemID`) VALUES (?,?)");
            $stmt->bindParam(1, $this->customerID, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->itemID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "Success";
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function deleteFromWishlist()
    {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM `wishlist` WHERE itemID = ? AND customerID = ?");
            $stmt->bindParam(1, $this->itemID, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->customerID, PDO::PARAM_INT);
            $stmt->execute();
            return "Success";
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function itemExist()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT count(*) FROM `wishlist` WHERE customerID = ? AND itemID = ?"); //use join
            $stmt->bindParam(1, $this->customerID, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->itemID, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            return $result > 0 ? $result : false;
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function getWishlist()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT item.itemID, item.name, item.stock, item.price, item.category, kind.kind, item.img FROM ((item
            INNER JOIN wishlist on wishlist.itemID = item.itemID)
            INNER JOIN kind on kind.kindID =item.kind) WHERE wishlist.customerID = ?"); //use join
            $stmt->bindParam(1, $this->customerID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }
}
?>