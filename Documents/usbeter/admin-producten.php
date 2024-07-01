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
            <h1>Producten beheer</h1>
        </div>
        <div class="admin-schema">
            <div class="schema">
                <div class="schema-rij">
                    <p><b><div>Product ID</div><div>Product naam</div><div>Product prijs</div></b></p>
                    </div>
                    <?php   
                    // connectie db
                    require 'extra/dbh.php';
                    require 'model/product.php';
                    require 'model/filter.php';

                    try{
                        $db = new Dbh();
                        $pdo = $db->connect();
                    }
                    catch (PDOException $e){
                        echo "Error!: " . $e->getMessage() . "<br/>";
                        die();
                    }

                    // haal alle producten op
                    // $product = new Product($name, $description, $price, $img, $category = null, $id = null);
                    $returnData = Product::getAllProducts($pdo);
                    // var_dump($returnData);
                    $products = $returnData['products'];


                    // echo alle producten in het format dat hieronder staat
                    foreach ($products as $prd) {
                        //var_dump($prd);
                        echo '<br>';
                        echo '<div class="schema-rij">';
                        echo '<a class="adminUserView" href="admin-productAanpassen.php?id=' . $prd->getId() . '">';
                        echo '<div>' . $prd->getId() . '</div>';
                        echo '<div>' . $prd->getProductName(). '</div>';
                        echo '<div>' . $prd->getPrice() . '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                
            </div>
        </div>
        <div class="admin-button">
            <a href="admin-productAdd.php">Product toevoegen</a>
        </div>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>