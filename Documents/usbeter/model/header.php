<header>
    <nav>
        <div class="profile">
            <?php
            session_start();
            try {
                if (isset($_SESSION['userId']) && $_SESSION['isActive'] = 1) {
                    if ($_SESSION['userInfo']['adminstatus'] == 1) {
                        echo '<a href="admin.php"><img class="profile-icon" src="Images-assets/default-pfp.jpg" alt=""></a>';
                    } else {
                        $userinfo = $_SESSION['userInfo'];
                        echo '<a href="account.php"><img class="profile-icon" src="Images-assets/default-pfp.jpg" alt=""></a>';
                    }
                } else {
                  header("Location: login.php");
                    echo '<a href="login.php">Login</a>';
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
            <div class="profile-name">
                <?php
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
        <a href="index.php"><img class="logo" src="Images-assets/burgerbuddy-express-logo-cropped.png"
                alt="BurgerBuddy Express Logo"></a>
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
                        <?php
                        try {
                            if (isset($_SESSION['userId']) && $_SESSION['isActive'] = 1) {
                                if ($_SESSION['userInfo']['adminstatus'] == 1) {
                                    echo '<a href="admin.php">Admin Profiel</a>';
                                } else {
                                    $userinfo = $_SESSION['userInfo'];
                                    echo '<a href="account.php">Profiel</a>';
                                }
                            } else {
                               header("Location: login.php");
                                echo '<a href="login.php">Login</a>';
                            }
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                        ?>
                        <?php
                        try {
                            if (isset($_SESSION['userId']) && $_SESSION['isActive'] = 1) {
                                if ($_SESSION['userInfo']['adminstatus'] == 1) {
                                    echo '<a href="admin.php"></a>';
                                } else {
                                    $userinfo = $_SESSION['userInfo'];
                                    echo '<a href="account.php">Bestelgeschiedenis</a>';
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