<?php
require_once('./db/Checkout.php');
require_once('./db/Payment.php');
require_once('./db/Sales.php');
require_once('./db/Cart.php');
require_once('./receipt/Receipt.php');
require_once('./receipt/Invoice.php');
require_once('./utils/PaymentMapping.php');
require_once('./utils/AuthValidationUtils.php');

session_start();
AuthValidationUtils::redirectIfNotLoggedIn();

if (!isset($_SESSION["Cart"])) {
    header('location: products.php');
}

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
        $_POST = array();
        $checkout->resetErrors();
        $sales->resetErrors();

        $billingAddressId = $checkout->saveBillingAddress();
        $sales->setBillingAddressId($billingAddressId);
        $sales->saveSalesDetail();
        $cart->completeSale();

        unset($_SESSION['Cart']);
        $_SESSION['Cart'] = null;

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
        $_SESSION["invoice"] = $sale;
        header("location: confirmation.php");
        exit();
    }
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
        <h1 class="text-center my-4">MobileCrunchers - Checkout</h1>
        <?php
        if ($checkout) {
            foreach ($checkout->getErrors() as $error) {
                echo "<h6 class='text-danger text-center mt-3'>$error</h6>";
            }
        }
        if ($sales) {
            foreach ($sales->getErrors() as $error) {
                echo "<h6 class='text-danger text-center mt-3'>$error</h6>";
            }
        }
        ?>
        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center flex-column mb-5">
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="firstname"><em>First Name</em></label>
                <input type="text" class="form-control" id="firstname" name="first_name" placeholder="First Name" aria-label="First Name" aria-describedby="First Name" value="<?= $checkout ? $checkout->getFirstName() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="username"><em>Last Name</em></label>
                <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Last Name" aria-label="Last Name" aria-describedby="Last Name" value="<?= $checkout ? $checkout->getLastName() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="username"><em>Email</em></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" aria-label="Email" aria-describedby="Email" value="<?= $checkout ? $checkout->getEmail() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="phone"><em>Phone</em></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="Phone" value="<?= $checkout ? $checkout->getPhone() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="address_line"><em>Address Line</em></label>
                <input type="text" class="form-control" id="address_line" name="address_line" placeholder="Address Line" aria-label="Address Line" aria-describedby="Address Line" value="<?= $checkout ? $checkout->getAddressLine() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="city"><em>City</em></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City" aria-label="city" aria-describedby="city" value="<?= $checkout ? $checkout->getCity() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="country"><em>Country</em></label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Country" aria-label="country" aria-describedby="country" value="<?= $checkout ? $checkout->getCountry() : '' ?>">
            </div>
            <div class="col-md-4 mx-auto mt-3">
                <label for="payment_method"><em>Payment Method</em></label>
                <select name="payment_method" class="form-select form-select-md">
                    <?php foreach ($paymentMethodsList as $payment) {
                        $selected = ($sales && $payment->getId() == $sales->getPaymentMethodId()) ? 'selected' : '';
                        echo "<option value='" . $payment->getId() . "' " . $selected . ">" . $payment->getName() . "</option>";
                    } ?>
                </select>
            </div>
            <div class="col-md-4 d-flex mx-auto">
                <button type="submit" class="btn btn-primary mt-4 col-md-12 mx-auto"><i class="bi bi-bag-check-fill me-2"></i>Order</button>
            </div>
        </form>
    </div>
    <?php include_once('components/footer.php') ?>

</body>

</html>