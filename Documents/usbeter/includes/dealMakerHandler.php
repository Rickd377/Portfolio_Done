<?php
include "../extra/dbh.php";
include "../model/deal.php";
// stel onze link is ...../?userId=1

session_start();
// check of je bent ingelogd als admin
if (!isset($_SESSION['userId']) && $_SESSION['adminstatus'] !== 1) {
    header("Location: login.php");
    exit();
}

// maak database connectie aan
$db = new Dbh();
$pdo = $db->Connect();

// check of het een post request is
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // dit mag niet
    header("Location: admin-deal.php");
} else {

    $dealId = htmlspecialchars($_POST['dealId']);
    $productId = htmlspecialchars($_POST["productId"]); 
    $dealName = htmlspecialchars($_POST["dealName"]);
    $oldPrice = htmlspecialchars($_POST["oldPrice"]);
    $newPrice = htmlspecialchars($_POST["newPrice"]);
    $dateFrom = htmlspecialchars($_POST["dateFrom"]);
    $dateTo = htmlspecialchars($_POST["dateTo"]);

   
    try {
    // haal de data uit de database
    $sql = $pdo->prepare("UPDATE deal SET new_price = :new_price, discount_percentage = :discount_percentage, date_from = :date_from, date_to = :date_to, image = :image, product_id = :product_id, deal_name = :deal_name WHERE id = :id");      
    
    $sql->bindParam(":new_price", $newPrice);
    $sql->bindParam(":discount_percentage", $discountPercentage);
    $sql->bindParam(":date_from", $dateFrom);
    $sql->bindParam(":date_to", $dateTo);
    $sql->bindParam(":image", $image);
    $sql->bindParam(":product_id", $productId);
    $sql->bindParam(":deal_name", $dealName);
    $sql->bindParam(":id", $dealId);

    $sql->execute();

    $rowCount = $sql->rowCount();
    
}catch (PDOException $e) {
        echo $e->getMessage();
    }
}
     header("Location: ../admin-deal.php");

// if (isset($_POST['delete'])) {
//   // product deleten
//   $productId = $_POST['productId'];
//   $productInfo = Product::GetProductInfo($pdo, $productId);
//   $temp = $productInfo->ProductToAssocArray();
//   $sql = $pdo->prepare("DELETE FROM product WHERE id = :id");
//   $sql->bindParam(":id", $productId);
//   $sql->execute();
//   $rowCount = $sql->rowCount();
//   if ($rowCount > 0) {
//       header("Location: ../admin-producten.php");
//   } else {
//       //header("Location: ../admin-productAdd.php?error=AAAAAAAAA went wrong, please try again later");
//   }
// }