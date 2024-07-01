<?php
session_start();
include "../extra/dbh.php";
include "../model/user.php";


// is het een post request?
if ($_SERVER['REQUEST_METHOD'] != 'POST' && !isset($_SESSION["signedup"])) {
    // dit mag niet
    header("Location: ../index.php");
    var_dump($_SESSION);
    exit();
}

$db = new Dbh();
$pdo = $db->Connect();

try {
    // haal de data uit de post
    var_dump($_POST);
    if ($_SESSION["signedup"] === true) {
        $email = htmlspecialchars($_SESSION["email"]);
        $password = htmlspecialchars($_SESSION["password"]);
        $_SESSION["email"] = null;
        $_SESSION["password"] = null;
        $_SESSION["signedup"] = null;
    } else {
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
    }

    // haal de data uit de database
    $sql = $pdo->prepare("SELECT id, password, isActive FROM customer WHERE email = :email");
    $sql->bindParam(":email", $email);
    $sql->execute();
    $rowCount = $sql->rowCount();

    if ($rowCount > 0) {
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        $hash = $data["password"];
        $hashedPw = password_hash($password, PASSWORD_DEFAULT);
        if (password_verify($password, $hash)) {

            // check if user is active
            if ($data["isActive"] == 0) {
                header("Location: ../login.php?error=Account is BLOCKED");
                exit();
            }


            $userId = htmlspecialchars($data["id"]);
            $_SESSION["userId"] = htmlspecialchars($userId);

            // userInfo is of type User
            $userInfo = User::getUserInfo($pdo, $userId);
            // session variables
            $_SESSION["userInfo"] = $userInfo->UserToAssocArray();
            if ($_SESSION['userInfo']['adminstatus'] == 1) {
                header("Location: ../admin.php");
                exit();
            } else {
                header("Location: ../account.php");
            }

        } else {
            header("Location: ../login.php?error=Email or password is incorrect");
        }
    }
} catch (PDOException $e) {
    //header("Location: ../login.php?error=Something went wrong, please try again later");
}
