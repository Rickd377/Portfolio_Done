<?php

require 'extra/dbh.php';
require 'controller/cartController.php';
require 'model/product.php';

$db = new dbh();
$pdo = $db->connect();

$ordersInfo = $_SESSION['cart'];

$htmlstring = '';

$ids = array_keys($ordersInfo);

// var_dump($ids);

// $sql = $pdo->prepare("SELECT * FROM deal");
// $sql->execute();
// $deals = $sql->fetch();



//check de productId van de deal hetzelfden is als de productId van een product in de cart, dan moet je de prijs veranderen van het product naar de prijs van de deal 

foreach ($ordersInfo as $productId => $orderInfo) {

    $product = Product::getProductById($pdo, $productId);
    $quantity = $orderInfo['quantity'];

    $htmlstring .= '<div class="product">
                    <div class="top-items">
                        <div class="name-top">
                            <h4>' . $product->getProductName() . '</h4>
                        </div>
                        <div class="price-top">
                            <h4>' . '€ ' . $product->getPrice() . '</h4>
                        </div>
                    </div>
                    <div class="bottom-items">
                        <div class="aantal-bottom">
                            <h5>' . 'Aantal: ' . $quantity . '</h5>
                        </div>
                    </div>
                </div>';

    //             $product=$product->getProductName();
    //             $price=$product->getPrice();

    //             $html=<<<HTML
    //             <div class="product">
    //                 <div class="top-items">
    //                     <div class="name-top">
    //                         <h4>$product</h4>
    //                     </div>
    //                     <div class="price-top">
    //                         <h4>€ $price</h4>
    //                     </div>
    //                 </div>
    //                 <div class="bottom-items">
    //                     <div class="aantal-bottom">
    //                         <h5>Aantal: $quantity</h5>
    //                     </div>
    //                 </div>
    //             </div>

    // HTML;
}
