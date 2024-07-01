<?php

//eerst de klant aanpassen
include "../extra/dbh.php";
include "../model/user.php";
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
    header("Location: admin-klanten.php");
} else {
    // haal de data uit de post
    $name = htmlspecialchars($_POST["name"]);
    $house_number = htmlspecialchars($_POST["house_number"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $userId = $_SESSION['userId'];

    try {
       
        // haal de data uit de database
        $sql = $pdo->prepare("UPDATE customer SET name = :name, house_number = :house_number, zip = :zip, phone = :phone WHERE id = :userId");
        $sql->bindParam(":name", $name);
        $sql->bindParam(":house_number", $house_number);
        $sql->bindParam(":zip", $zip);
        $sql->bindParam(":phone", $phone);
        $sql->bindParam(":userId", $userId);
        $sql->execute();

        $rowCount = $sql->rowCount();

        if ($rowCount > 0) {
            echo 'gelukt';
            header("Location: ../index.php");
        } else {
            echo 'niet gelukt';
        } 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// nu voor de order

$deliveryOption = htmlspecialchars($_POST["deliveryOptions"]);
$paymentMethod = htmlspecialchars($_POST["paymentMethodes"]);

