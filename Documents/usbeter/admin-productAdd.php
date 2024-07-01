<!DOCTYPE html>
<html lang="en">
<?php session_start();
if (!isset($_SESSION['userId']) && $_SESSION['adminstatus'] !== 1) {
    header("Location: login.php");
    exit();
}
?>
<head>
    <title>BurgerBuddy Express</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="login">

    <main class="login">
        <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png" alt="BurgerBuddy Express Logo"></a>
        <form class="register" action="includes/productAdd.php" method="post" enctype="multipart/form-data">
            <div class="form-title">
                <h1>Product Toevoegen</h1>
            </div>
            <div class="input-section">
                <input type="text" required autocomplete="off" name="name" placeholder="Naam">
                <input type="text" required autocomplete="off" name="description" placeholder="Beschrijving">
                <!-- <input type="text" required autocomplete="off" name="category_id" placeholder="Categorie"> -->
                <select class="input-section" name="category_id">
                <?php
                    require_once "extra/dbh.php";
                    $db = new Dbh();
                    $pdo = $db->Connect();
                    $sql = $pdo->prepare("SELECT * FROM category");
                    $sql->execute();
                    $categories = $sql->fetchAll();
                    foreach ($categories as $category) {
                        echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                    }
                 ?>
                </select>
                <input type="text" required autocomplete="off" name="price" placeholder="Prijs">
                <input type="file" name="fileToUpload" class="input-product">
                <button type="submit" name="submit">Product Toevoegen</button>
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