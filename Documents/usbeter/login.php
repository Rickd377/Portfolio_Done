<!DOCTYPE html>
<html lang="en">

<?php
    include_once 'model/head.php';
?>

<body id="login">

    <main class="login">
        <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png" alt="BurgerBuddy Express Logo"></a>
        <form class="login-form" action="includes/loginHandler.php" method="post">
            <h1>Inloggen</h1>
            <input type="text" id="email" name="email" placeholder="Email" required autocomplete="off">
            <input type="password" id="password" name="password" placeholder="Wachtwoord" required autocomplete="off">
            <button type="submit" name="submit">Inloggen</button>
            <div class="switch">
                <p>Nog geen account? <a href="register.php">Registreer</a></p>
            </div>
        </form>
    </main>

    <?php
        include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>