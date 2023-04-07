<?php
session_start();
require_once('./db/Cart.php');
require_once('./utils/formValidationUtils.php');
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

$html = "<div>";

foreach ($cart->getCartDetail() as $cartItem) {
    $html .= "
        <div>
            {$cartItem->getImagePath()} \t 
            {$cartItem->getName()} \t 
            {$cartItem->getQuantity()} \t 
            {$cartItem->getPrice()} \t
        </div>";
    $html .= "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
    $html .= "<input type='hidden' name='product_id' value='" . $cartItem->getProductId() . "' />";
    $html .= "<input type='submit'value='Remove' />";
    $html .= "</form>";
}

$html .= "Total: {$cart->getTotal()}";
$html .= "</div>";
$html .= "<a href='checkout.php'>Checkout</a>";

echo $html;
