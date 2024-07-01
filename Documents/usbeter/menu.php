<?php
require_once 'config.php'
    ?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'model/head.php';
?>

<body>
    <?php
    include_once 'model/header.php';
    ?>


    <main class="menu">
        <div class="main-page">
            <form action="" method="get"></form>
                <div class="filter-icon">
                    <i class="fa-solid fa-filter"></i>
                </div>
                <div class="filter-dropdown-menu" style="display: none;">
                    <?php
                    $filterController = new filterController();
                    ?>
                </div>
            </form>
            <div class="sectie" id="sectie">
                <?php
                $productController = new productController();
                ?>
            </div>
        </div>
        <div class="cart">
            <div class="cart-content">
                <div class="cart-title">
                    <h1>Winkelmandje</h1>
                </div>
                <div class="cart-items" id="cart-items">
                    
                    
                </div>
                <a href="pay.html" class="paybtn">Afrekenen</a>
            </div>
</div>
            <button class="button">
                <i class="fa-solid fa-caret-up arrow1" style="color: #BE3245; font-size: 30px; margin:6px 0 0 0;"></i>
                Winkelmandje
                <i class="fa-solid fa-caret-up arrow2" style="color: #BE3245; font-size: 30px; margin:6px 0 0 0"></i>
            </button>
    </main>

    <?php
    include_once 'model/footer.php';
    ?>

    <script src="general.js"></script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {

            // Function to fetch the cart contents on page load
            function initializeCart() {
                fetch('model/cart.php')
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (data) {
                        console.log(data);
                        document.getElementById('cart-items').innerHTML = data;
                        updateListeners();
                    });
            }

            // Function to update the event listeners for the "add to cart" buttons
            function updateListeners() {
                var addProductButtons = document.getElementsByClassName("updateProduct");
                Array.from(addProductButtons).forEach(function (element) {
                    var newElement = element.cloneNode(true);
            element.parentNode.replaceChild(newElement, element);

            newElement.addEventListener("click", function (event) {
                event.preventDefault();

                        var form = new FormData();

                        // Select the child element using querySelector (modify the selector based on your HTML structure)
                        var childElement = element.querySelector('i#addProduct'); // Assuming the child is an <i> element with ID 'addProduct'

                        // Access the attributes of the child element
                        if (childElement) {
                            let productId = childElement.getAttribute('data');
                            let action = childElement.getAttribute('action');

                            if (action === 'update') {
                                let direction = childElement.getAttribute('direction');
                                form.append('direction', direction);
                            }
                            console.log('Product ID:', productId);
                            console.log('Action:', action);
                            form.append('id', productId);
                            form.append('action', action);
                        }

                        var removeChildElement = element.querySelector('i#removeProduct');
                        if (removeChildElement) {
                            productId = removeChildElement.getAttribute('data');
                            action = removeChildElement.getAttribute('action');
                            if (action === 'update') {
                                let direction = removeChildElement.getAttribute('direction');
                                form.append('direction', direction);
                            }
                            console.log('Product ID:', productId);
                            console.log('Action:', action);
                            form.append('id', productId);
                            form.append('action', action);
                        }

                        fetch('model/cart.php', {
                            method: 'POST',
                            contentType: 'form-data',
                            body: form
                        })
                            .then(function (response) {
                                return response.text();
                            })
                            .then(function (data) {
                                document.getElementById('cart-items').innerHTML = data;
                                updateListeners(); // Update listeners after the cart is updated
                            });
                    });
                });
            }

            // Initialize cart and listeners on page load
            console.log("loaded");
            initializeCart();
        });

    </script>
</body>

</html>