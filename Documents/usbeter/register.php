<!DOCTYPE html>
<html lang="en">


<head>
    <title>BurgerBuddy Express</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="login">

    <main class="login">
        <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png"
                alt="BurgerBuddy Express Logo"></a>
        <form class="register" action="includes/signupHandler.php" method="post">
            <div class="form-title">
                <h1>Account aanmaken</h1>
            </div>
            <div class="input-section">
                <input type="text" required autocomplete="off" name="name" placeholder="Naam">
                <input type="text" required autocomplete="off" name="house_number" placeholder="Huisnummer">
                <input type="text" required autocomplete="off" name="email" placeholder="E-mail">
                <input type="text" required autocomplete="off" name="zip" placeholder="Postcode">
                <input type="password" required autocomplete="off" name="password" placeholder="Wachtwoord">
                <input type="text" required autocomplete="off" name="phone" placeholder="Telefoon">
                <button type="submit" name="submit">Registreren</button>
            </div>
            <div class="switch">
                <p>Heb je al een account? <a href="login.php">Log in</a></p>
        </form>
    </main>

    <footer>
        <div class="voorwaarden">
            <p>BurgerBuddy Express © | Algemene Voorwaarden | Privacyverklaring | Cookieverklaring</p>
        </div>
        <div class="social-media">
            <a href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.x.com"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.facebook.com"><i class="fa-brands fa-facebook"></i></a>
        </div>
    </footer>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>