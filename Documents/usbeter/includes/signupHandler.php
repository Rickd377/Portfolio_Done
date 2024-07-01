<?php
session_start();

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
    $passwordPreHash = $password;

    //hashing
    $password = password_hash($password, PASSWORD_DEFAULT);

    $newUser = new User($name, $password, $email, $phone, $house_number, $zip);

    $name = $newUser->getName();
    $password = $newUser->getPassword();
    $email = $newUser->getEmail();
    $phone = $newUser->getPhone();
    $house_number = $newUser->getHouseNumber();
    $zip = $newUser->getZip();

    // hier gaan we de data in de database zetten
    $sql = $pdo->prepare("INSERT INTO customer (name, password, email, phone, house_number, zip) VALUES (:name, :password, :email, :phone, :house_number, :zip)");

    $sql->bindParam(":name", $name);
    $sql->bindParam(":password", $password);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":phone", $phone);
    $sql->bindParam(":house_number", $house_number);
    $sql->bindParam(":zip", $zip);
    $sql->execute();

    // dit om te kijken of een rij is toegevoegd
    $rowCount = $sql->rowCount();



    if ($rowCount > 0) {
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $passwordPreHash;
        $_SESSION["signedup"] = true;
        header("Location: loginHandler.php");
    } else {
        header("Location: ../signup.php?error=AAAAAAAAA went wrong, please try again later");
    }
} catch (UserException $e) {
    header("Location: ../signup.php?error=" . $e->getMessage());
} catch (PDOException $e) {

    header("Location: ../signup.php?error=" . $e->getMessage());
}