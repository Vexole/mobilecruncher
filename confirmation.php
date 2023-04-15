<?php
require_once('./receipt/Receipt.php');
require_once('./receipt/Invoice.php');
require_once('./utils/AuthValidationUtils.php');

session_start();
AuthValidationUtils::redirectIfNotLoggedIn();

if (!isset($_SESSION["invoice"])) {
    header('location: products.php');
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST["btnAction"] == 'View') {
        $sale = $_SESSION["invoice"];
        $invoice = new Invoice();
        $invoice->generateInvoice($sale);
    } else {
        header('location: products.php');
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
        <h1 class="text-center my-4">MobileCrunchers - Successful Order!</h1>
        <div class="card col-md-4 mx-auto pb-4 mb-4">
            <h4 class="text-center my-4 mc-color-secondary">Thank you for shopping with us.</h4>
            <form method="POST" class="mx-auto">
                <button type="submit" name="btnAction" value="View" class="btn btn-primary me-4"><i class="bi bi-file-pdf me-2"></i>View Invoice</button>
                <button type="submit" name="btnAction" value="Continue" class="btn btn-primary"><i class="bi bi-cart-fill me-2"></i>Continue Shopping</button>
            </form>
        </div>

    </div>
    <?php include_once('components/footer.php') ?>
</body>

</html>