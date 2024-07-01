<?php
session_start();

$_SESSION['cart'] = [];
// product Id 1 met quantity 1 - 1 kipburger
//$_SESSION['cart'][5] = array("quantity" => 1);
// product Id 2 met quantity 4 - 4 hamburgers
$_SESSION['cart'][2] = array("quantity" => 1);
// product Id 3 met quantity 5 - 5 cheeseburgers
$_SESSION['cart'][3] = array("quantity" => 1);

//$_SESSION['cart'][4] = array("quantity" => 1);

//$_SESSION['cart'][1] = array("quantity" => 1);

$_SESSION['cart'][8] = array("quantity" => 1);

//$_SESSION['cart'][5] = array("quantity" => 5);




// winkelmandje weergeven.
require 'config.php';
require 'view/payCartView.php';
require 'view/payPriceView.php';
// $cartController = new cartController();

// haal alle producten op uit db.

// haal prijzen en productnamen op van producten in cart.

// haal deal op uit database.
// kijk of deal in cart zit.
// doe berekening van deal.

// toon subttotaal en totaal

// -----------------------------
// logica voor invulvelden neerzetten
// haal gebruikersdata op uit db. ($_Session zou userId vast moeten houden toch?)
// vul op basis daarvan die velden in.

// bijvoorbeeld
// $seesion['userId'] = 1;
$db = new Dbh();
$pdo = $db->connect();

// $_SESSION['userId'] = 35;

$UserInfo = User::getUserInfo($pdo, $_SESSION['userId']);
$userName = $UserInfo->getName();
$houseNumber = $UserInfo->getHouseNumber();
$zip = $UserInfo->getZip();
$phone = $UserInfo->getPhone();

// // update deze velden in de database.

// $sql = "UPDATE customers SET name = :name, house_number = :house_number, zip = :zip, phone = :phone WHERE id = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['name' => $userName, 'houseNumber' => $houseNumber, 'zip' => $zip, 'phone' => $phone, 'id' => $_SESSION['userId']]);


// var_dump($userName);



// // Function to get the deal price for a product
// function getDealPrice($pdo, $productId) {
//     $sql = $pdo->prepare("SELECT new_price FROM deal WHERE product_id = :productId");
//     $sql->execute(['productId' => $productId]);
//     $deal = $sql->fetch();
    
//     if ($deal) {
//         return $deal['new_price'];
//     }
    
//     return null;
// }

// // Check if the product in the cart is also a deal
// foreach ($_SESSION['cart'] as $productId => $product) {
//     // Get the deal price for the product
//     $dealPrice = getDealPrice($pdo, $productId);
    
//     // If a deal price exists, replace the standard product price with the deal price
//     if ($dealPrice) {
//         $_SESSION['cart'][$productId]['price'] = $dealPrice;
//     }
// }



?>

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

                    // totaalprijs weergeven van alle producten in cart.

                    // laat de bestelopties zien (ophalen, delivery, etc)

                    // betaalmethodes/ doe een dropdown ofzo (hou het simpel)

                    // 
                    // exit();
                    try {
                        if (isset($_SESSION['userId']) && $_SESSION['isActive'] = 1) {
                            if ($_SESSION['userInfo']['adminstatus'] == 1) {
                                echo '<a href="admin.php">Admin</a>';
                            } else {
                                $userinfo = $_SESSION['userInfo'];
                                echo '<a href="account.php">', $userinfo['name'] . '</a>';
                            }
                        } else {
                            header("Location: login.php");
                            echo '<a href="login.php">Login</a>';
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    ?>
                </div>
            </div>
            <a href="index.html"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png" alt=""></a>
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
                            <a href="#">Bestelgeschiendenis</a>
                        </div>
                    </div>
                    <div class="menu-dropdown">
                        <div class="category">
                            <a class="big-letter-dropdown" href="menu.php">Menu</a>
                            <i class="fa fa-caret-up"></i>
                        </div>
                        <div class="not-category">
                            <a href="menu.php#deals">Deals</a>
                            <a href="menu.php#vleesburgers">Vlees Burgers</a>
                            <a href="menu.php#kipburgers">Kip Burgers</a>
                            <a href="menu.php#snacks">Snacks</a>
                            <a href="menu.php#dranken">Dranken</a>
                        </div>
                    </div>
                    <div class="klantenservice-dropdown">
                        <a href="klantenservice.html">Klantenservice</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="pay">
        <div class="side-menu">
            <div class="side-title">
                <h2>Jouw Bestelling</h2>
            </div>
            <div class="side-products">
                <?= $htmlstring ?>
            </div>
            <?= $payString?>
        </div>
        <div class="main-page">
            <form class="inputs-main" action="includes/orderConfigurate.php" method="post" enctype="multipart/form-data">
                <div class="naam">
                    <label for="naam">Naam</label>
                    <br>
                    <input type="text" name="name" value=<?php echo $userName ?>>
                </div>
                <div class="woonplaats">
                    <label for="woonplaats">Telefoon</label>
                    <br>
                    <input type="text" name="phone" value="<?php echo $phone ?>">
                </div>
                <div class="huisnummer">
                    <label for="huisnummer">Huisnummer</label>
                    <br>
                    <input type="text" name="house_number" value="<?php echo $houseNumber; ?>">
                </div>
                <div class="postcode">
                    <label for="postcode">Postcode</label>
                    <br>
                    <input type="text" name="zip" value="<?php echo $zip ?>">
                </div>
                <div class="dropdownDelivery">
                    <select class="dropdown-deliver" name="deliveryOptions">
                    
                        <?php
                        require_once "extra/dbh.php";
                        $db = new Dbh();
                        $pdo = $db->Connect();
                        $sql = $pdo->prepare("SELECT * FROM delivery_option");
                        $sql->execute();
                        $deliveryMethodOptions = $sql->fetchAll();
                        echo "<option value='' disabled selected> Bezorgopties</option>";
                        foreach ($deliveryMethodOptions as $deliveryMethodOption) {
                            // Include the title or another field as the visible text for each option
                            echo "<option value='" . $deliveryMethodOption['title'] . "'>" . $deliveryMethodOption['title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="dropdownDelivery">
                    <select class="dropdown-pay" name="paymentMethodes">
                        <?php
                        require_once "extra/dbh.php";
                        $db = new Dbh();
                        $pdo = $db->Connect();
                        $sql = $pdo->prepare("SELECT * FROM paymethod");
                        $sql->execute();
                        $paymentMethods = $sql->fetchAll();
                        echo "<option value='' disabled selected> Betaalmethodes</option>";
                        foreach ($paymentMethods as $paymentMethod) {
                            // Include the title or another field as the visible text for each option
                            echo "<option value='" . $paymentMethod['title'] . "'>" . $paymentMethod['title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" class="betaal-btn" value="Betalen">
            </form>

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