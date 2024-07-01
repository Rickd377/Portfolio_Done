<!DOCTYPE html>
<html lang="en">

<?php
include_once 'model/head.php';
include 'view/dealview.php';

?>
<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BurgerBuddy Express</title>
    <link rel="stylesheet" href="style.css">
    </head> -->

<body>
    <?php
    include_once 'model/header.php';
    ?>

    <main class="home">
        <?php echo $htmlstring; ?>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>