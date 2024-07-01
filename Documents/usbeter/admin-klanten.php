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
            <h1>Klanten beheer</h1>
        </div>
        <div class="admin-schema">
            <div class="schema">
                <div class="schema-rij">
                    <p><b><div>Klant ID</div><div>Klant naam</div><div>Klant E-mail</div><div>isActive</div><div>Adminstatus</div></b></p>
                </div>
                <?php
                // connectie db
                require 'extra/dbh.php';
                require 'model/User.php';

                $db = new dbh();
                $pdo = $db->connect();

                // haal alle gebruikers op
                $name = null;
                $email = null;
                $password = null;
                $adminstatus = null;
                $id = null;
                $isActive = null;

                $user = new User($pdo, $name, $email, $password, $adminstatus, $id, $isActive);
                $users = $user->getAllUsers($pdo);

                // echo alle gebruikers in het format dat hieronder staat
                foreach ($users as $user) {
                    $temp = $user->UserToAssocArray();
                    echo '<br>';
                    echo '<div class="schema-rij">';
                    echo '<a class="adminUserView" href="admin-klantAanpassen.php?id=' . $temp['id'] . '">';	
                    echo '<div>' . $temp['id'] . '</div>';
                    echo '<div>' . $temp['name'] . '</div>';
                    echo '<div>' . $temp['email'] . '</div>';
                    echo '<div>' . $temp['isActive'] . '</div>';
                    echo '<div>' . $temp['adminstatus'] . '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
                <!-- <div><p>Klant ID  | Klant naam | Klant E-mail</p></div>
                <div><a href="admin-klantAanpassen.php"> 1 | Jan Jansen | jan@jemoeder.com </a></div> -->
            </div>
        </div>
        <div class="admin-button">
            <a href="admin-klantAdd.php">Klant Toevoegen</a>
        </div>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>