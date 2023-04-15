<?php
session_start();
require_once('./db/Cart.php');
require_once('./utils/FormValidationUtils.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfNotLoggedIn();
$cart = new Cart(["userId" => $_SESSION["userId"]]);
$cart->getCartDetails();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    $productId = FormValidationUtils::sanitizeFields($_POST['product_id']);
    foreach ($cart->getCartDetail() as $cartItem) {
        if ($cartItem->getProductId() == $productId) {
            $cart->setTotal($cart->getTotal() - ($cartItem->getPrice() * $cartItem->getQuantity()));
            break;
        }
    }
    $cart->updateCart();
    $cart->removeProductFromCart($productId);
    header('location: cart.php');
}
?>

<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once('components/header.php') ?>

    <div class="container-fluid">
        <h1 class="text-center my-4">MobileCrunchers - Cart</h1>
        <?php
        $html = "<div class='col-md-6 mx-auto'>";
        foreach ($cart->getCartDetail() as $cartItem) {
            $html .= "<div class='card my-4 p-3'>";
            $html .= "
                <div class='cart-item'>
                <img class='cart-product-image' src='images/{$cartItem->getImagePath()}' alt='{$cartItem->getImagePath()}'> \t 
                <h5>{$cartItem->getQuantity()} x {$cartItem->getName()} \t 
                <span class='mc-color-primary'> \${$cartItem->getPrice()}<span></h5> \t";
            $html .= "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
            $html .= "<input type='hidden' name='product_id' value='" . $cartItem->getProductId() . "' />";
            $html .= "<button type='submit' class='btn btn-secondary btn-sm float-end'><i class='bi bi-trash3-fill me-2'></i>Remove</button>";
            $html .= "</form>";
            $html .= "</div>";
            $html .= "</div>";
        }

        if ($cart->getCartDetail()) {
            $html .= "<h3 class='my-4 mc-color-primary text-end'><em>Total: \${$cart->getTotal()}</em></h3>";
            $html .= "<div class='mb-5 col-md-6 mx-auto'>";
            $html .= "<a href='checkout.php' class='btn btn-primary btn-lg col-md-12'><i class='bi bi-cart-check-fill me-2'></i>Checkout</a>";
            $html .= "</div>";
        } else {
            $html .= '<h5 class="text-center my-4">Cart is Empty! Try Adding Products.</h5>';
        }
        $html .= "</div>";
        echo $html;
        ?>
    </div>
    <?php include_once('components/footer.php') ?>
</body>
</html>