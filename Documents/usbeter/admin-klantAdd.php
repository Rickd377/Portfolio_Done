<!DOCTYPE html>
<html lang="en">

<?php
include_once 'model/head.php';
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['adminstatus'] !== 1) {
    header("Location: login.php");
    exit();
}
?>

<body id="login">

    <main class="login">
        <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png" alt="BurgerBuddy Express Logo"></a>
        <form class="register" action="includes/signupHandlerAdmin.php" method="post">
            <div class="form-title">
                <h1>Klant Toevoegen</h1>
            </div>
            <div class="input-section">
                <input type="text" required autocomplete="off" name="name" placeholder="Naam">
                <input type="text" required autocomplete="off" name="house_number" placeholder="Huisnummer">
                <input type="text" required autocomplete="off" name="email" placeholder="E-mail">
                <input type="text" required autocomplete="off" name="zip" placeholder="Postcode">
                <input type="text" required autocomplete="off" name="password" placeholder="Wachtwoord">
                <input type="text" required autocomplete="off" name="phone" placeholder="Telefoon">
                <input type="text" required autocomplete="off" name="adminstatus" placeholder="Adminstatus">
                <button type="submit" name="submit">Klant Toevoegen</button>
            </div>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>