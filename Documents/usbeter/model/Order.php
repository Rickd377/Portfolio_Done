<?php

class OrderException extends Exception
{
}

class Order {
    private $id;
    private $customerId;
    private $paymentMethodId;
    private $deliveryOptionId;
    private $date;

    public function __construct($id, $customerId, $paymentMethodId, $deliveryOptionId, $date) {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->paymentMethodId = $paymentMethodId;
        $this->deliveryOptionId = $deliveryOptionId;
        $this->date = $date;
    }

    public function getId() {
        return $this->id;
    }

    public function getCustomerId() {
        return $this->customerId;
    }

    public function getPaymentMethodId() {
        return $this->paymentMethodId;
    }

    public function getDeliveryOptionId() {
        return $this->deliveryOptionId;
    }

    public function getDate() {
        return $this->date;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
    }

    public function setPaymentMethodId($paymentMethodId) {
        $this->paymentMethodId = $paymentMethodId;
    }

    public function setDeliveryOptionId($deliveryOptionId) {
        $this->deliveryOptionId = $deliveryOptionId;
    }

    public function setDate($date) {
        $this->date = $date;
    }


    public static function getAllOrders() {
        $db = new Dbh();
        $pdo = $db->connect();

        $sql = $pdo->prepare("SELECT * FROM order");
        $sql->execute();

        $orders = $sql->fetchAll();

        return $orders;
    }

    public static function getOrderById($id) {
        $db = new Dbh();
        $pdo = $db->connect();

        $sql = $pdo->prepare("SELECT * FROM order WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();

        $order = $sql->fetch();

        return $order;
    }

    public static function createOrder($customerId, $paymentMethodId, $deliveryOptionId, $date) {
        $db = new Dbh();
        $pdo = $db->connect();

        $sql = $pdo->prepare("INSERT INTO order (customer_id, payment_method_id, delivery_option_id, date) VALUES (:customerId, :paymentMethodId, :deliveryOptionId, :date)");
        $sql->bindParam(":customerId", $customerId);
        $sql->bindParam(":paymentMethodId", $paymentMethodId);
        $sql->bindParam(":deliveryOptionId", $deliveryOptionId);
        $sql->bindParam(":date", $date);
        $sql->execute();

        $rowCount = $sql->rowCount();

        // hier doen we de order has product
        $orderId = $pdo->lastInsertId();

        foreach ($_SESSION['cart'] as $product) {
            $sql = $pdo->prepare("INSERT INTO order_has_product (order_id, product_id, quantity) VALUES (:orderId, :productId, :quantity)");
            $sql->bindParam(":orderId", $orderId);
            $sql->bindParam(":productId", $product);
            $sql->bindParam(":quantity", $product['quantity']);
            $sql->execute();
        }
    }

}
