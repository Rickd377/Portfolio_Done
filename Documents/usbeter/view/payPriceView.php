<?php

require_once 'model/product.php';


$ordersInfo = $_SESSION['cart'];

$payString = '';

$subTotalPrice = 0;
$discountPrice = 0;
$totalPrice = 0;
    
$product = Product::getProductById($pdo, $productId);
$quantity = $ordersInfo[$productId]['quantity'];

$sql = $pdo->prepare("SELECT * FROM deal");
$sql->execute();
$deals = $sql->fetch();

foreach ($ordersInfo as $productId => $orderInfo) {
    if ($productId == $deals['product_id']) {
        $discountPrice = ($product->getPrice() - $deals['new_price']) / 100;
    }
}



$ids = array_keys($ordersInfo);








foreach ($ids as $productId) {
    $product = Product::getProductById($pdo, $productId);
    $quantity = $ordersInfo[$productId]['quantity'];

    $subTotalPrice += $product->getPrice() * $quantity;
}
//maak een variabele voor de korting die je krijgt als je een deal in je cart hebt staan

$totalPrice = $subTotalPrice + $discountPrice;

$payString .= '<div class="side-price">
                    <div class="subtotaal">
                        <div class="name">
                            <h4>Subtotaal:</h4>
                        </div>
                        <div class="price">
                            <h4>€ ' . $subTotalPrice . '</h4>
                        </div>
                    </div>
                    <div class="korting">
                        <div class="name">
                            <h4>Korting:</h4>
                        </div>
                        <div class="price">
                            <h4>€ ' . $discountPrice . '</h4>
                        </div>
                    </div>
                    <div class="totaal">
                        <div class="name">
                            <h3>Totaal:</h3>
                        </div>
                        <div class="price">
                            <h3>€ ' . $totalPrice . '</h3>
                        </div>
                    </div>
                </div>';
