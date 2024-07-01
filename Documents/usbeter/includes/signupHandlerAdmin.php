<?php

// is het een post request?
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // dit mag niet

    // doe een redirect naar de login pagina
    header("Location: ../login.php");
}

require_once "../model/user.php";
require_once "../extra/dbh.php";

$db = new Dbh();
$pdo = $db->Connect();

try {
    $name = htmlspecialchars($_POST["name"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);     
    $phone = htmlspecialchars($_POST["phone"]);
    $house_number = htmlspecialchars($_POST["house_number"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $adminstatus = htmlspecialchars($_POST["adminstatus"]);


    $newUser = new User($name, $password, $email, $phone, $house_number, $zip, adminstatus:$adminstatus);

    //hashen
    $password = password_hash($newUser->getPassword(), PASSWORD_DEFAULT);

    // hier gaan we de data in de database zetten
    $sql = $pdo->prepare("INSERT INTO customer (name, password, email, phone, house_number, zip, adminstatus) VALUES (:name, :password, :email, :phone, :house_number, :zip, :adminstatus)");

    $sql->bindParam(":name", $name);
    $sql->bindParam(":password", $password);
    $sql->bindParam(":email", $newUser->getEmail());
    $sql->bindParam(":phone", $newUser->getPhone());
    $sql->bindParam(":house_number", $newUser->getHouseNumber());
    $sql->bindParam(":zip", $newUser->getZip());
    $sql->bindParam(":adminstatus", $newUser->getAdminstatus());    
    $sql->execute();

    // dit om te kijken of een rij is toegevoegd
    $rowCount = $sql->rowCount();
    //var_dump($rowCount);



    if ($rowCount > 0) {
        header("Location: ../admin-klanten.php");
    } else {
        header("Location: ../admin-klantAdd.php?error=AAAAAAAAA went wrong, please try again later");
    }
} catch (UserException $e) {
    header("Location: ../admin-klantAdd.php?error=" . $e->getMessage());
} catch (PDOException $e) {

    header("Location: ../admin-klantAdd.php?error=" . $e->getMessage());
}