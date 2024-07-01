<!DOCTYPE html>
<html lang="en">

<head>
    <title>BurgerBuddy Express</title>
    <link rel="stylesheet" href="style.css">
</head>

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

    <main class="admin-klant">
        <div class="admin-text">
            <h1>Deal beheer</h1>
        </div>
        <div class="admin-schema">
            <div class="schema">
                <div class="schema-rij">
                    <p><b><div>ID</div><div>Naam</div><div>Prijs</div><div>Verwijderen</div></b></p>                  
                </div>
                    <?php
                    session_start();
                    // connectie db
                    require 'extra/dbh.php';
                    require 'model/deal.php';

                    try{
                        $db = new Dbh();
                        $pdo = $db->connect();
                    }
                    catch (PDOException $e){
                        echo "Error!: " . $e->getMessage() . "<br/>";
                        die();
                    }

                
                    $returnData = Deal::getAllDeals($pdo);
                    // var_dump($returnData);
                    $deals = $returnData;


                    // echo alle deals in het format dat hieronder staat
                    foreach ($deals as $deal) {
                        echo '<br>';
                        echo '<div class="schema-rij">';
                        echo '<div>' . $deal->getId() . '</div>'; 
                        echo '<div>' . $deal->getDealName(). '</div>'; 
                        echo '<div>' . $deal->getNewPrice() . '</div>';
                        echo '<a class="adminUserView" href="includes/dealDestroy.php?id=' . $deal->getId() . '">';
                        echo '<div>' . '<p>Verwijderen</p>' . '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
            </div>
        </div>
        <div class="admin-button">
            <a href="admin-dealAdd.php">Deal maken</a>
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