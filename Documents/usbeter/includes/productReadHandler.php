<?php

require '../config.php';

// maak database connectie aan
$db = new Dbh();
$pdo = $db->Connect();

// check of het een post request is
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $product = new productController();
}