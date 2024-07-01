<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include_once 'model/head.php';
if(!isset($_SESSION['userId'])){
    header("Location: login.php");
    exit();
}
?>

<body>
    <header>
        <nav>
            <div class="profile">
            <?php
                    if (isset($_SESSION['userId']) && isset($_SESSION['userInfo']) && $_SESSION['isActive'] = 1) {
                        $userinfo = $_SESSION['userInfo'];
                        echo '<a href="logout.php"><img class="profile-icon" src="Images-assets/default-pfp.jpg" alt=""></a>';
                    } else {
                        echo '<a href="login.php"><img class="profile-icon" src="Images-assets/default-pfp.jpg" alt=""></a>';
                    } ?>
                <div class="profile-name">
                    <?php
                    if (isset($_SESSION['userId']) && isset($_SESSION['userInfo']) && $_SESSION['isActive'] = 1) {
                        $userinfo = $_SESSION['userInfo'];
                        echo '<a href="logout.php"> Log uit </a>';
                    } else {
                        echo '<a href="login.php"> Login </a>';
                    } ?>
                </div>
            </div>
            <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png" alt="BurgerBuddy Express Logo"></a>
            <div class="hamburger-menu">
                <i class="fa fa-burger"></i>
                <i class="fa fa-caret-up"></i>
                <div class="dropdown-menu">
                    <div class="account-dropdown">
                        <div class="category">
                            <a class="big-letter-dropdown" href="account.php">Account</a>
                            <i class="fa fa-caret-up"></i>
                        </div>
                        <div class="not-category">
                            <a href="account.php">Profiel</a>
                            <a href="account.php">Bestelgeschiedenis</a>
                        </div>
                    </div>
                    <div class="menu-dropdown">
                        <div class="category">
                            <a class="big-letter-dropdown" href="menu.php">Menu</a>
                            <i class="fa fa-caret-up"></i>
                        </div>
                        <div class="not-category">
                            <a href="menu.php">Deals</a>
                            <a href="menu.php">Vlees Burgers</a>
                            <a href="menu.php">Kip Burgers</a>
                            <a href="menu.php">Snacks</a>
                            <a href="menu.php">Dranken</a>
                        </div>
                    </div>
                    <div class="klantenservice-dropdown">
                        <a href="klantenservice.php">Klantenservice</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="account">
        <div class="title">
            <h1>Mijn Account</h1>
        </div>
        <div class="mainsection">
            <div class="information">
                <div class="personal-info">
                    <div class="left-items">
                        <p>Naam:</p>
                        <br>
                        <p>Email adres:</p>
                        <br>
                        <p>Telefoonnummer:</p>
                    </div><?php
                            echo '<div class="right-items">
                        <p>' . $userinfo['name'] . '</p>
                        <br>
                        <p>' . $userinfo['email'] . '</p>
                        <br>
                        <p>' . $userinfo['phone'] . '</p>
                    </div>';
                            ?>
                </div>
                <br>
                <div class="adres-info">
                    <div class="left-items">
                        <p>Postcode:</p>
                        <br>
                        <p>Huisnummer:</p>
                    </div>
                    <?php
                    echo '<div class="right-items">
                        <p>' . $userinfo['zip'] . '</p>
                        <br>
                        <p>' . $userinfo['house_number'] . '</p>
                    </div>';
                    ?>
                </div>
            </div>
            <div class="history">
                <div class="personal-info">
                    <div class="left-items bestel">
                        <p>datum: 03 - 05 - 2024</p>
                        <p>aantal: 3x</p>
                        <p>prijs: €57,-</p>
                        <p>betaalmethode: IDEAL</p>
                        <p>bezorgoptie: Express-levering</p>
                    </div>
                </div>
                <div class="adres-info">
                    <div class="left-items">
                        <p>datum: 03 - 05 - 2024</p>
                        <p>aantal: 3x</p>
                        <p>prijs: €57,-</p>
                        <p>betaalmethode: IDEAL</p>
                        <p>bezorgoptie: Express-levering</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>