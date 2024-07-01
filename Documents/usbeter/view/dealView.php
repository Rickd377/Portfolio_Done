<?php
// connectie db
require 'extra/dbh.php';
include 'model/deal.php';

$db = new dbh();
$pdo = $db->connect();

//$deals = new Deal($id, $new_price, $discount_percentage, $date_from, $date_to, $img, $product_id, $deal_name);
//$deals = $deals->getAllDeals($pdo);
$allDeals = Deal::getAllDeals($pdo);

$htmlstring = '';

    foreach ($allDeals as $deal) {
        $htmlstring .= '
                <div class="deals">
                    <div class="deal-text">
                        <p>Nu ' . $deal->getDiscountPercentage() . '% korting op ' . $deal->getDealName() . '</p>
                        <br>
                        <a href="menu.php" class="btn">menu</a>
                    </div>
                    <img src="img/' . $deal->getImg() . '" alt="product image">               
                </div>
            </div>';
    }

    
