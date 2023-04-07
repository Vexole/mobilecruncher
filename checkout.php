<?php
require_once('./db/Checkout.php');
require_once('./db/Payment.php');
require_once('./db/Sales.php');
require_once('./db/Cart.php');
require_once('./receipt/Receipt.php');
require_once('./receipt/Invoice.php');
require_once('./utils/PaymentMapping.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfNotLoggedIn();
session_start();

$paymentMethods = new Payment();
$paymentMethodsList = $paymentMethods->getPaymentMethods();
$checkout = null;
$sales = null;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $billingAddressId = 1;

    $checkout = new Checkout($_POST);
    $cart = new Cart(["userId" => $_SESSION["userId"]]);
    $cart->getCartDetails();
    $sales = new Sales($_SESSION["Cart"], $cart->getTotal(), $_POST['payment_method'], $billingAddressId);

    if (!$checkout->hasErrors() && !$sales->hasErrors()) {
        $billingAddressId = $checkout->saveBillingAddress();
        $sales->setBillingAddressId($billingAddressId);
        $sales->saveSalesDetail();
        $cart->completeSale();

        unset($_SESSION['Cart']);
        $_SESSION['Cart'] = null;

        $invoice = new Invoice();
        $items = [];
        foreach ($cart->getCartDetail() as $cartItem) {
            $items[] = array(
                "name" => $cartItem->getName(),
                "qty" => $cartItem->getQuantity(),
                "price" => $cartItem->getPrice()
            );
        }
        $sale = new Receipt(
            $checkout->getFirstName(),
            $checkout->getLastName(),
            PaymentMapping::$paymentMapping[$sales->getPaymentMethodId()],
            $items,
            0,
            $sales->getTotal()
        );
        $invoice->generateInvoice($sale);
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <?php
    if ($checkout) {
        foreach ($checkout->getErrors() as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    if ($sales) {
        foreach ($sales->getErrors() as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        FirstName: <input type="text" name="first_name" value="<?= $checkout ? $checkout->getFirstName() : '' ?>" />
        LastName: <input type="text" name="last_name" value="<?= $checkout ? $checkout->getLastName() : '' ?>" />
        Email: <input type="email" name="email" value="<?= $checkout ? $checkout->getEmail() : '' ?>" />
        Phone: <input type="number" name="phone" value="<?= $checkout ? $checkout->getPhone() : '' ?>" />
        Address Line: <input type="text" name="address_line" value="<?= $checkout ? $checkout->getAddressLine() : '' ?>" />
        City: <input type="text" name="city" value="<?= $checkout ? $checkout->getCity() : '' ?>" />
        Country: <input type="text" name="country" value="<?= $checkout ? $checkout->getCountry() : '' ?>" />

        Payment:
        <select name="payment_method">
            <?php foreach ($paymentMethodsList as $payment) {
                $selected = ($sales && $payment->getId() == $sales->getPaymentMethodId()) ? 'selected' : '';
                echo "<option value='" . $payment->getId() . "' " . $selected . ">" . $payment->getName() . "</option>";
            } ?>
        </select>
        <input type="submit" value="Checkout" />
    </form>
</body>

</html>