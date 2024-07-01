<?php
require '../config.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'];
    $productID = $_POST['id'];

    $cartController = new cartController();

    switch ($action) {
        case 'add':
            $cartController->addToCart($productID);
            break;
        case 'remove':
            $cartController->removeFromCart($productID);
            break;
        case 'update':
            $direction = $_POST['direction'];
            $cartController->updateCart($productID, $direction);
            break;
        default:
            echo "Invalid action.";
    }
    // voor elk item in de sgv session willen wij productdetails ophalen.

    // die zetten we in een lijstje

    // die gaan wij echoen als json.
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cartController = new cartController();
    $cartController->displayCart();
}