<?php
class Order extends DB
{

    private $customerId;
    private $items;
    private $orderID;

    public function __construct($customerId, $items = NULL)
    {
        $this->customerId = $customerId;
        $this->items = $items;
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
            $stmt = $this->connect()->prepare("INSERT INTO `placedorder`(`customerID`, `status`, `time_placed`) VALUES (?,1, NOW());");
            $stmt->bindParam(1, $this->customerId, PDO::PARAM_INT);
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

    private function getOderIds()
    {
        try {
            $ID = $this->customerId;
            if ($ID) {
                $stmt = $this->connect()->query("SELECT `orderID` FROM `placedorder` WHERE customerID = '$ID'");
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
    public function getCustomerOrders()
    {
        try {
            $ids = $this->getOderIds();
            $array = array();
            foreach ($ids as $id) {
                $curID = $id["orderID"];
                $stmt = $this->connect()->query("SELECT `itemID`, `quantity`,  `orderID`  FROM `cart_items` WHERE orderID = '$curID'");
                $result = $stmt->fetchALL();
                if (isset($result)) {
                    $array[$curID] = $result;
                }
            }
            return $array;
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }


}


?>