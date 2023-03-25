<?php
class Cart extends DB
{
    private $customerId = null;
    private $itemID;
    private $quantity;
    private $cartID = 0;

    private $prevQnty;
    public function __construct($customerId, $itemID = null, $quantity = null)
    {
        $this->customerId = $customerId;
        $this->itemID = $itemID;
        $this->quantity = $quantity;
    }

    public function setItemToCart()
    {
        if (!isset($this->customerId) || $this->customerId == null) {
            return "No customer";
        }
        $insertCart = $this->insertCart();
        $prevQnty = $this->userAddedSameItem();
        try {
            if ($prevQnty) {
                $sum = $prevQnty + $this->quantity;
                $stmt = $this->connect()->prepare("UPDATE `cart_items` SET `quantity`=? WHERE cartID = ? AND itemID = ?");
                $stmt->bindParam(1, $sum, PDO::PARAM_INT);
                $stmt->bindParam(2, $this->cartID, PDO::PARAM_INT);
                $stmt->bindParam(3, $this->itemID, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                if ($insertCart) {

                    $stmt = $this->connect()->prepare("INSERT INTO `cart`(`customerID`) VALUES (?)");
                    $stmt->bindParam(1, $this->customerId, PDO::PARAM_INT);
                    $stmt->execute();
                    $this->userHasCart(); #reassign the cartID by the just inserted order
                }
                $stmt = $this->connect()->prepare("INSERT INTO `cart_items`(`cartID`, `itemID`, `quantity`) VALUES (?,?,?)");
                $stmt->bindParam(1, $this->cartID, PDO::PARAM_INT);
                $stmt->bindParam(2, $this->itemID, PDO::PARAM_INT);
                $stmt->bindParam(3, $this->quantity, PDO::PARAM_INT);
                $stmt->execute();
            }
            return "Succcess";
        } catch (PDOException $e) {
            return "Error" . $e . ".";
            // die();
        }
    }

    public function getItems()
    {
        try {
            $ID = $this->customerId;
            $stmt = $this->connect()->query("SELECT item.itemID, item.name, item.stock, item.price, item.category, item.kind, item.img, cart_items.quantity FROM ((item INNER JOIN cart_items on item.itemID = cart_items.itemID) INNER JOIN cart on cart.cartID = cart_items.cartID) WHERE cart.customerID = '$ID'");
            $result = $stmt->fetchALL();
            if (isset($result)) {
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    /**
     * make new order if:
     * user is not in the Order table,
     * user is in the table but already checked out
     */

    #checks if to insert a new row in the Order table
    private function insertCart()
    {
        if ($this->userHasCart()) {
            return false;
        }
        return true;
    }

    #checks if a user is already in the Order table
    private function userHasCart()
    {
        try {
            $ID = $this->customerId;
            $stmt = $this->connect()->query("SELECT cartID FROM `cart` WHERE customerID = '$ID'"); #gets the last order made by the customer
            //        $stmt->bindParam(1, $this->itemID, PDO::PARAM_INT);
            // $stmt->bindParam(2, $this->customerID, PDO::PARAM_INT);
            $result = $stmt->fetchALL();
            if (isset($result[0]["cartID"])) {
                $this->cartID = $result[0][0];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }


    private function userAddedSameItem()
    {
        try {
            $cartID = $this->cartID;
            $itemID = $this->itemID;
            $stmt = $this->connect()->query("SELECT quantity FROM `cart_items` WHERE cartID = '$cartID' AND itemID = '$itemID'");
            $result = $stmt->fetchAll();
            if (isset($result[0][0])) {
                return $result[0][0];
            }
            return 0;
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }

    public function deleteItem()
    {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM `cart_items` WHERE itemID = ? AND cartID = (SELECT `cartID` FROM `cart` WHERE customerID = ?)");
            $stmt->bindParam(1, $this->itemID, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->customerId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            if (isset($result[0][0])) {
                return $result[0][0];
            }
            return 0;
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }
}


?>