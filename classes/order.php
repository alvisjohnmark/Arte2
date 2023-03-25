<?php
class Order extends DB
{
    private $customerId = null;
    private $itemID;
    private $quantity;
    private $orderID = 0;

    private $prevQnty;
    public function __construct($customerId, $itemID = null, $quantity = null)
    {
        $this->customerId = $customerId;
        $this->itemID = $itemID;
        $this->quantity = $quantity;

    }

    public function setItemToOrder()
    {
        if (!isset($this->customerId) || $this->customerId == null) {
            return "No customer";
        }

        $makeNewOrder = $this->makeNewOrder();
        $prevQnty = $this->userMadeSameOrder();
        try {
            if ($prevQnty) {
                $sum = $prevQnty + $this->quantity;
                $stmt = $this->connect()->prepare("UPDATE `order_item` SET `quantity`=? WHERE orderID = ? AND itemID = ?");
                $stmt->bindParam(1, $sum, PDO::PARAM_INT);
                $stmt->bindParam(2, $this->orderID, PDO::PARAM_INT);
                $stmt->bindParam(3, $this->itemID, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                if ($makeNewOrder) {

                    $stmt = $this->connect()->prepare("INSERT INTO `orders`(`customerID`, `chkOut`) VALUES (?,0)");
                    $stmt->bindParam(1, $this->customerId, PDO::PARAM_INT);
                    $stmt->execute();
                    $this->userInOrder(); #reassign the orderID by the just inserted order
                }
                $stmt = $this->connect()->prepare("INSERT INTO `order_item`(`orderID`, `itemID`, `quantity`) VALUES (?,?,?)");
                $stmt->bindParam(1, $this->orderID, PDO::PARAM_INT);
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
            $stmt = $this->connect()->query("SELECT item.itemID, item.name, item.stock, item.price, item.category, item.kind, item.img FROM ((item INNER JOIN order_item on item.itemID = order_item.itemID) INNER JOIN orders on orders.orderID = order_item.orderID) WHERE orders.customerID = '$ID'");
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
    private function makeNewOrder()
    {
        if ($this->userInOrder() && !$this->userCheckedOut()) {
            return false;
        }
        return true;
    }

    #checks if a user is already in the Order table
    private function userInOrder()
    {
        try {
            $ID = $this->customerId;
            $stmt = $this->connect()->query("SELECT MAX(orderID) FROM `orders` WHERE customerID = '$ID'"); #gets the last order made by the customer
            //        $stmt->bindParam(1, $this->itemID, PDO::PARAM_INT);
            // $stmt->bindParam(2, $this->customerID, PDO::PARAM_INT);
            $result = $stmt->fetchALL();
            if (isset($result[0]["MAX(orderID)"])) {
                $this->orderID = $result[0][0];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    #checks if user already checkout its order
    private function userCheckedOut()
    {
        try {
            $ID = $this->orderID;
            $stmt = $this->connect()->query("SELECT chkOut FROM `orders` WHERE orderID = '$ID'"); #gets the if the order is checked out or not
            $result = $stmt->fetchALL();
            if (isset($result[0][0])) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }

    private function userMadeSameOrder()
    {
        try {
            $orderID = $this->orderID;
            $itemID = $this->itemID;
            $stmt = $this->connect()->query("SELECT quantity FROM `order_item` WHERE orderID = '$orderID' AND itemID = '$itemID'");
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