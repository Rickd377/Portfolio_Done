<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include_once 'model/head.php';
//var_dump($_SESSION);
if(!isset($_SESSION['userId']) && $_SESSION['adminstatus']!== 0){
    header("Location: login.php");
    exit();
}
?>

<body>
    <header>
        <nav>
            </div>
            <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png" alt="BurgerBuddy Express Logo"></a>
            <div class="hamburger-menu">
                <i class="fa fa-burger"></i>
                <i class="fa fa-caret-up"></i>
                <div class="dropdown-menu">
                    <div class="account-dropdown">
                        <div class="category">
                            <a class="big-letter-dropdown" href="#">Admin</a>
                            <i class="fa fa-caret-up"></i>
                        </div>
                        <div class="not-category">
                            <a href="admin-klanten.php">klanten beheer</a>
                            <a href="admin-producten.php">Producten beheer</a>
                            <a href="admin-bestelling.php">Bestelling beheer</a>
                            <a href="admin-deal.php">Deals beheer</a>
                        </div>
                    </div>
                    <div class="klantenservice-dropdown">
                        <a href="logout.php">Uitloggen</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="admin-home">
        <div class="admin-text">
            <h1>Admin Paneel</h1>
        </div>
        <div class="ahome-button">
            <a href="admin-klanten.php">Klanten beheer</a>
            <a href="admin-producten.php">Producten beheer</a>
            <a href="admin-bestelling.php">Bestelling beheer</a>
            <a href="admin-deal.php">Deals beheer</a>
        </div>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>