<!DOCTYPE html>
<html lang="en">

<head>
    <title>BurgerBuddy Express</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <div class="profile">
                <img class="profile-icon" src="Images-assets/default-pfp.jpg" alt="">
                <div class="profile-name">
                    <?php
                    session_start();
                    if (isset($_SESSION['userId']) && isset($_SESSION['userInfo'])) {
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
                            <a class="big-letter-dropdown" href="#">Account</a>
                            <i class="fa fa-caret-up"></i>
                        </div>
                        <div class="not-category">
                            <a href="#">Profiel</a>
                            <a href="#">Bestelgeschiedenis</a>
                        </div>
                    </div>
                    <div class="menu-dropdown">
                        <div class="category">
                            <a class="big-letter-dropdown" href="menu.php">Menu</a>
                            <i class="fa fa-caret-up"></i>
                        </div>
                        <div class="not-category">
                            <a href="menu.html#deals">Deals</a>
                            <a href="menu.html#vleesburgers">Vlees Burgers</a>
                            <a href="menu.html#kipburgers">Kip Burgers</a>
                            <a href="menu.html#snacks">Snacks</a>
                            <a href="menu.html#dranken">Dranken</a>
                        </div>
                    </div>
                    <div class="klantenservice-dropdown">
                        <a href="klantenservice.php">Klantenservice</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="home">
        <div class="home-img">
            <div class="sale-vburgers">
                <div class="sale-img">
                    <img src="Images-assets/file.png">
                </div>
                <div class="img-shadow"></div>
            </div>
        </div>
        <div class="home-img">
            <div class="sale-kburgers">
                <div class="sale-img">
                    <img src="Images-assets/mcchicken-sandwich.png">
                </div>
                <div class="img-shadow"></div>
            </div>
        </div>
        <div class="home-img">
            <div class="sale-dranken">
                <div class="sale-img">
                    <img class="cola" src="Images-assets/cola.png">
                </div>
                <div class="img-shadow"></div>
            </div>
        </div>
        <div class="home-img">
            <div class="sale-snacks">
                <div class="sale-img">
                    <img src="Images-assets/fries.png">
                </div>
                <div class="img-shadow"></div>
            </div>
        </div>
        <div class="main-text">
            <div class="sale-text">
                <div class="sale-vburgers">
                    <p>2 + 1 gratis op alle vleesburgers!</p>
                </div>
                <div class="sale-kburgers">
                    <p>3 + 1 gratis op alle kipburgers</p>
                </div>
                <div class="sale-dranken">
                    <p>Gratis cola bij 2 burgers</p>
                </div>
                <div class="sale-snacks">
                    <p>1 euro korting op grote patat!</p>
                </div>

            </div>
            <div class="menu-btn">
                <a href="menu.php">Ons Menu</a>
            </div>
        </div>
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