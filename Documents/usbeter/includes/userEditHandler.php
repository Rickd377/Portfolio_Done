<?php
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
    $email = htmlspecialchars($_POST["email"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $adminstatus = htmlspecialchars($_POST["adminstatus"]);
    $userId = htmlspecialchars($_POST["userId"]);

    try {
    // haal de data uit de database
    $sql = $pdo->prepare("UPDATE customer SET name = :name, house_number = :house_number, email = :email, zip = :zip, phone = :phone, adminstatus = :adminstatus WHERE id = :userId");
    $sql->bindParam(":name", $name);
    $sql->bindParam(":house_number", $house_number);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":zip", $zip);
    $sql->bindParam(":phone", $phone);
    $sql->bindParam(":adminstatus", $adminstatus);
    $sql->bindParam(":userId", $userId);
    $sql->execute();

    $rowCount = $sql->rowCount();
    

    // if ($rowCount > 0) {
    //     echo 'gelukt';
    // } else {
    //     echo 'niet gelukt';
    // } 
}catch (PDOException $e) {
        echo $e->getMessage();
    }
}
     header("Location: ../admin-klanten.php");

if (isset($_POST['block'])) {
    // want je wil ze blokkeren als ze niet geblokkeerd zijn.
    $userId = $_POST['userId'];
    $sql = $pdo->prepare("UPDATE customer SET isActive = false WHERE id = :userId");
    $sql->bindParam(":userId", $userId);
    $sql->execute();
    header("Location: ../admin-klanten.php");
}

if (isset($_POST['unblock'])) {
    // want je wil ze blokkeren als ze niet geblokkeerd zijn.
    $userId = $_POST['userId'];
    $sql = $pdo->prepare("UPDATE customer SET isActive = true WHERE id = :userId");
    $sql->bindParam(":userId", $userId);
    $sql->execute();
    header("Location: ../admin-klanten.php");
}