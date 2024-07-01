<?php
// session_start();

// require '../config.php';

class cartController
{
    public PDO $db;

    public function __construct()
    {
        $this->createDBConnection();
    }
    function createDBConnection()
    {
        $dbh = new Dbh();
        $this->db = $dbh->Connect();
    }
    public function addToCart($productID)
    {
        // Assume you have a function to get product details by ID
        //$product = Product::getProductById($this->db, $productID);

        if (!isset($_SESSION['cart'])) {
            // maken een leeg lijstje met de key 'cart'
            $_SESSION['cart'] = [];
        }

        // staat het productId al in het lijstje van 'cart'?
        // dan zeggen wij quantity += 1
        if (isset($_SESSION['cart'][$productID])) {
            // Increment the quantity
            $_SESSION['cart'][$productID]['quantity']++;
            // bestaat de productId nog niet in het lijstje van 'cart'?
            // voeg hem toe aan 'cart' met quantity = 1
        } else {
            // Add the product with quantity 1
            $_SESSION['cart'][$productID] = array("quantity" => 1);
        }

        $this->displayCart();
    }

    public function removeFromCart($productID)
    {
        if (isset($_SESSION["cart"][$productID])) {
            unset($_SESSION["cart"][$productID]);
            // $_SESSION['cart'][$productID]['quantity']--;
        }

        $this->displayCart();
    }

    public function updateCart($productID, $direction)
    {

        if (isset($_SESSION["cart"][$productID])) {
            if ($direction === "plus") {
                $_SESSION["cart"][$productID]["quantity"]++;
            } else if ($direction === "minus") {
                if ($_SESSION["cart"][$productID]["quantity"] > 1) {
                    $_SESSION["cart"][$productID]["quantity"]--;
                } else {
                    unset($_SESSION["cart"][$productID]);
                }
            }
        }
        $this->displayCart();
    }

    public function displayCart()
    {
        global $db;

        if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
            // var_dump($_SESSION["cart"]);
            // exit;
            foreach ($_SESSION["cart"] as $productID => $cartItem) {
                $product = Product::getProductById($this->db, $productID);
                $quantity = $cartItem["quantity"];
                $cost = $product->getPrice() * $quantity;

                echo '<div class="product">
                        <div class="top-items">
                            <div class="product-name">
                                <h3>' . $product->getProductName() . '</h3>
                            </div>
                            <div class="product-price">
                                <h3>' . $product->getPrice() . '</h3>
                            </div>
                        </div>
                        <br>
                        <div class="bottom-items">
                            <div class="minus">
                                <button class="updateProduct">
                                    <i class="fa-solid fa-minus" id="removeProduct" action="update" direction="minus" data="' . $productID . '"></i>
                                </button>
                            </div>
                            <div class="amount">
                                <h3 style="color: #BE3245;">' . $quantity . '</h3>
                            </div>
                            <div class="plus">
                                <button  class="updateProduct">
                                    <i class="fa-solid fa-plus" id="addProduct" action="update" direction="plus" data="' . $productID . '"></i>
                                </button>
                            </div>
                        </div>
                        <div class="total-cart">
                            <p>Totaal: ' . $cost . '</p>
                        </div>
                    </div>';
            }
        }
    }
}
