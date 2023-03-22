<?php
class Order extends DB
{
    private $customerId = null;
    private $itemID;
    private $quantity;
    private $orderID = 0;
    public function __construct($customerId, $itemID, $quantity)
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
        try {
            if ($this->makeNewOrder()) {
                $stmt = $this->connect()->prepare("INSERT INTO `order`(`customerID`, `chkOut`) VALUES (?,0)");
                $stmt->bindParam(1, $this->customerId, PDO::PARAM_INT);
                $stmt->execute();
                $this->userInOrder(); #reassign the orderID by the just inserted order
            }
            $stmt = $this->connect()->prepare("INSERT INTO `order_item`(`orderID`, `itemID`, `quantity`) VALUES (?,?,?)");
            $stmt->bindParam(1, $this->orderID, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->itemID, PDO::PARAM_INT);
            $stmt->bindParam(3, $this->quantity, PDO::PARAM_INT);
            $stmt->execute();
            return "Succcess";
        } catch (PDOException $e) {
            return "Error" . $e . ".";
            // die();
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
            $stmt = $this->connect()->query("SELECT MAX(orderID) FROM `order` WHERE customerID = '$ID'"); #gets the last order made by the customer
            //        $stmt->bindParam(1, $this->itemID, PDO::PARAM_INT);
            // $stmt->bindParam(2, $this->customerID, PDO::PARAM_INT);
            $result = $stmt->fetchALL();
            if ($result[0]["MAX(orderID)"]) {
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
            $stmt = $this->connect()->query("SELECT chkOut FROM `order` WHERE orderID = '$ID'"); #gets the if the order is checked out or not
            $result = $stmt->fetchALL();
            if ($result[0][0]) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }
}


?>