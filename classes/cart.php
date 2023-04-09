<?php
class Cart extends DB
{
    private $customerId = null;
    private $itemID;
    private $quantity;
    private $cartID = 0;
    private $stock = null;

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
        $this->getItemStock(); //set the number of stock of the item
        try {
            if ($prevQnty) {
                $sum = $prevQnty + $this->quantity;
                if ($sum > $this->stock) {
                    $sum = $this->stock;
                }
                $this->updateCartItems($sum);
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

    private function getItemStock()
    {
        try {
            $ID = $this->itemID;
            $stmt = $this->connect()->query("SELECT item.stock FROM `item` WHERE itemID = '$ID'");
            $result = $stmt->fetchALL();
            if (isset($result[0]["stock"])) {
                $this->stock = $result[0][0];
                return;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }



    public function getItems()
    {
        try {
            $ID = $this->customerId;
            $stmt = $this->connect()->query("SELECT item.itemID, item.name, item.stock, item.price, item.category, item.img, cart_items.quantity, kind.kind FROM (((item INNER JOIN cart_items on item.itemID = cart_items.itemID) INNER JOIN cart on cart.cartID = cart_items.cartID)INNER JOIN kind on kind.kindID = item.kind) WHERE cart.customerID = '$ID'");
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

    //use to update the quantity of items in the cart
    public function updateCartItems($sum = null)
    {
        if ($this->userHasCart()) {
            $toSet = $sum ? $sum : $this->quantity;
            $stmt = $this->connect()->prepare("UPDATE `cart_items` SET `quantity`=? WHERE cartID = ? AND itemID = ?");
            $stmt->bindParam(1, $toSet, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->cartID, PDO::PARAM_INT);
            $stmt->bindParam(3, $this->itemID, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            return "Not added";
        }

        return $this->cartID;
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

    private function deleteCart()
    {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM `cart` WHERE cartID = ?");
            $stmt->bindParam(1, $this->cartID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 1;
            }
            return 0;
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
    }

    public function placeorder()
    {
        try {
            $this->userHasCart();
            $stmt = $this->connect()->prepare("INSERT INTO `placedorder`(`customerID`, `cartID`, `status`, `time_placed`) VALUES (?,?,1, NOW())");
            $stmt->bindParam(1, $this->customerId, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->cartID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if ($this->deleteCart() == 1) {
                    return "Success";
                }
            }
            return "Error";
        } catch (PDOException $e) {
            print "Error" . $e . ".";
            die();
        }
        // return "Succeess";

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

    public function getItemsQuantity()
    {
        try {
            $ID = $this->customerId;
            if ($ID) {
                $stmt = $this->connect()->query("SELECT SUM(cart_items.quantity) FROM cart_items INNER JOIN cart on cart_items.cartID = cart.cartID WHERE cart.customerID = '$ID'");
                $result = $stmt->fetchALL();
                if (isset($result)) {
                    return $result;
                } else {
                    return 0;
                }
            }
            return 0;
        } catch (PDOException $e) {
            return "Error" . $e . ".";
        }
    }
}


?>