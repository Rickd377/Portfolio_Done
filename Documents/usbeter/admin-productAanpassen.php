<!DOCTYPE html>
<html lang="en">

<?php
include_once 'model/head.php';
include 'extra/dbh.php';
include 'model/product.php';
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
        //maak een form aan om de product aan te passen
        //haal de product op
        $productId = $_GET['id'];
        $productInfo = Product::GetProductInfo($pdo, $productId);
        $temp = $productInfo->ProductToAssocArray();
        // vul in de input velden de gegevens van de product
        ?>
         <div class="form-klantaanpassen">
            <form class="register" action="includes/ProductEditHandler.php" method="post" enctype="multipart/form-data">
                <div class="form-title">
                    <h1>Product Aanpassen</h1>
                </div>
                <div class="input-section">
                    <?php
                    echo '<div class="input-container">';
                    echo '<div class="label">';
                    echo '<label for="name">Naam</label>';
                    echo '<input type="text" required autocomplete="off" name="name" placeholder="Naam" value="' . $temp['name'] . '">';
                    echo '</div>';
                    echo '<img id="productAdminImage" src="img/' . $temp['image'] . '" alt="product image">';
                    if ($temp['image'] !== null) {
                        echo '<input type="hidden" name="currentImage" value ="' . $temp['image'] . '">';
                    }
                    echo '<input type="file" name="fileToUpload">';
                    echo '<label for="description">Beschrijving</label>';
                    echo '<input type="text" required autocomplete="off" name="description" placeholder="Beschrijving" value="' . $temp['description'] . '">';
                    echo '</div>';
                    echo '<select class="input-section" name="category_id">';
                    $sql = $pdo->prepare("SELECT * FROM category");
                    $sql->execute();
                    $categories = $sql->fetchAll();
                    foreach ($categories as $category) {
                        echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                    }
                    echo '</select>';
                    echo '<label for="price">Prijs</label>';
                    echo '<input type="text" required autocomplete="off" name="price" placeholder="Prijs" value="' . $temp['price'] . '">';
                    echo '</div>';
                    echo '<input type="hidden" name="productId" value="' . $temp['id'] . '">';
                    echo '</div>';
                    echo '</div>';
                    //echo '<input type="text" required autocomplete="off" name="adminstatus" placeholder="Adminstatus" value="' . $productInfo['adminstatus'] . '">';
                    ?>
                    <button type="submit" name="submit">Opslaan</button>
                    <button type="submit" name="delete">Verwijderen</button>
                </div>
            </form>
        </div>
    </main>



    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>