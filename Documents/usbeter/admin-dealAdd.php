<!DOCTYPE html>
<html lang="en">

<head>
    <title>BurgerBuddy Express</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="login">

    <main class="login">
        <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png"
                alt="BurgerBuddy Express Logo"></a>
        <form class="register" action="includes/dealAdd.php" method="post" enctype="multipart/form-data">
            <div class="form-title">
                <h1>Deal Maken</h1>
            </div>
            <div class="input-section">
                <input type="text" required autocomplete="off" name="dealName" placeholder="Naam">
                <input type="text" required autocomplete="off" name="newPrice" placeholder="Nieuwe prijs">
                <select class="input-section" name="productId">
                <?php
                    require_once "extra/dbh.php";
                    $db = new Dbh();
                    $pdo = $db->Connect();
                    $sql = $pdo->prepare("SELECT * FROM product");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    foreach ($products as $product) {
                        echo "<option value='" . $product['id'] . "'>" . $product['name'] . "</option>";
                    }
                 ?>
                </select>
                <input type="file" name="fileToUpload" class="input-product">
                <input type="datetime-local" required autocomplete="off" name="dateFrom" placeholder="Datum van">
                <input type="datetime-local" required autocomplete="off" name="dateTo" placeholder="Datum tot">
                <button type="submit" name="submit">Deal maken</button>
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