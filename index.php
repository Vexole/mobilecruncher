<!DOCTYPE html>
<html>

<body>
    <h1>Welcome</h1>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="products.php">Products</a>
</body>

</html>

<?php
ob_start();
require_once("./receipt/Invoice.php");
require_once("./sale.php");

// $invoice = new Invoice();
// $items = array(
//     array("name" => "Item 1", "qty" => "3", "price" => "45"),
//     array("name" => "Item 2", "qty" => "7", "price" => "75")
// );
// $sale = new Sale("Bhupesh", "Shrestha", "Cash", $items, 58, 880);
// $invoice->generateInvoice($sale);
// ob_end_flush();
?>