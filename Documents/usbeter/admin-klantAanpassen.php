<!DOCTYPE html>
<html lang="en">

<?php
include_once 'model/head.php';
include 'extra/dbh.php';
include 'model/User.php';
//include 'includes/userEditHandler.php';
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['adminstatus'] !== 1) {
    header("Location: login.php");
    exit();
}
// connectie db'
$db = new dbh();
$pdo = $db->connect();
?>

<body id="login">

    <main class="login">
        <?php
        //maak een form aan om de klant aan te passen
        //haal de klant op
        $userId = $_GET['id'];
        $userInfo = User::getUserInfo($pdo, $userId);
        $temp = $userInfo->UserToAssocArray();
        //var_dump($temp)
        // vul in de input velden de gegevens van de klant
        ?>
        <div class="form-klantaanpassen">
            <form class="register" action="includes/userEditHandler.php" method="post">
                <div class="form-title">
                    <h1>Klant Aanpassen</h1>
                </div>
                <div class="input-section">
                    <?php
                    echo '<div class="input-container">';
                    echo '<div class="label">';
                    echo '<label for="name">Naam</label>';
                    echo '<input type="text" required autocomplete="off" name="name" placeholder="Naam" value="' . $temp['name'] . '">';
                    echo '</div>';
                    echo '<div class="label">';
                    echo '<label for="house_number">Huisnummer</label>';
                    echo '<input type="text" required autocomplete="off" name="house_number" placeholder="Huisnummer" value="' . $temp['house_number'] . '">';
                    echo '</div>';
                    echo '<div class="label">';
                    echo '<label for="email">Email</label>';
                    echo '<input type="text" required autocomplete="off" name="email" placeholder="E-mail" value="' . $temp['email'] . '">';
                    echo '</div>';
                    echo '<div class="label">';
                    echo '<label for="zip">Postcode</label>';
                    echo '<input type="text" required autocomplete="off" name="zip" placeholder="Postcode" value="' . $temp['zip'] . '">';
                    echo '</div>';
                    echo '<div class="label">';
                    echo '<label for="phone">Telefoon nummer</label>';
                    echo '<input type="text" required autocomplete="off" name="phone" placeholder="Telefoon" value="' . $temp['phone'] . '">';
                    echo '</div>';
                    echo '<input type="hidden" name="userId" value="' . $temp['id'] . '">';
                    echo '<div class="label">';
                    echo '<label for="adminstatus">Adminstatus</label>';
                    echo '<input type="text" required autocomplete="off" name="adminstatus" placeholder="Adminstatus" value="' . $temp['adminstatus'] . '">';
                    echo '</div>';
                    echo '</div>';
                    ?>
                    <button type="submit" name="submit">Opslaan</button>
                    <button type="submit" name="block">Blokkeren</button>
                    <button type="submit" name="unblock">Deblokkeren</button>
                </div>
            </form>
        </div>
    </main>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>