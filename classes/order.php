<?php
class Order extends DB
{

    private $customerId;
    private $items;
    private $orderID;
    private $cost;
    private $address;

    public function __construct($customerId, $items = NULL, $cost = 0, $address = null)
    {
        $this->address = $address;
        $this->customerId = $customerId;
        $this->items = $items;
        $this->cost = $cost;
    }

    private function getInsertedOrderID()
    {
        try {
            $stmt = $this->connect()->query("SELECT MAX(orderID) FROM `placedorder`");
            $result = $stmt->fetchALL();
            if (isset($result)) {
                return $result[0][0];
            }
            return "Error";
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }

    private function updateOrderID($item)
    {
        try {
            $stmt = $this->connect()->prepare("UPDATE `cart_items` SET `orderID`= ? WHERE itemID = ? AND orderID IS NULL");
            $stmt->bindParam(1, $this->orderID, PDO::PARAM_INT);
            $stmt->bindParam(2, $item, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function setOrder()
    {

        try {
            // $this->setAddress();
            // $this->getAddressID();
            $stmt = $this->connect()->prepare("INSERT INTO `placedorder`(`customerID`, `status`, `time_placed`, `cost`, `address`) VALUES (?,1, NOW(), ?, ?);");
            $stmt->bindParam(1, $this->customerId, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->cost, PDO::PARAM_INT);
            $stmt->bindParam(3, $this->address, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $this->orderID = $this->getInsertedOrderID();
                foreach ($this->items as $item) {
                    $this->updateOrderID($item);
                }
                return "Success";
            }
            return "Error";
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }

    public function getOrders()
    {
        try {
            $ID = $this->customerId;
            if ($ID) {
                $stmt = $this->connect()->query("SELECT `orderID`, `time_placed`,`cost`, status.status FROM `placedorder` INNER JOIN status on status.statusID = placedorder.status  WHERE customerID = '$ID' ORDER BY orderID");
                $result = $stmt->fetchALL();
                if (isset($result)) {
                    return $result;
                } else {
                    return 0;
                }
            }
            return "No user";
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }
    public function getOrderItems($orderID)
    {
        try {
            $stmt = $this->connect()->query("SELECT placedorder.orderID, placedorder.address, placedorder.cost, item.name, item.img, cart_items.quantity, item.price FROM `placedorder`INNER JOIN cart_items on cart_items.orderID = placedorder.orderID INNER JOIN item on item.itemID = cart_items.itemID WHERE placedorder.orderID = '$orderID'");
            $result = $stmt->fetchALL();
            if (isset($result)) {
                return $result;

            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

    public function cancelOrder($orderID)
    {
        try {
            $stmt = $this->connect()->prepare("UPDATE `placedorder` SET `status`= 3 WHERE orderID = '$orderID'");
            if ($stmt->execute()) {
                return "Success";
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }

}


?>