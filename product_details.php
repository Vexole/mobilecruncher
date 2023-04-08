<?php
require_once('./db/Product.php');
require_once('./db/Cart.php');
require_once('./db/CartDetail.php');
require_once('./utils/formValidationUtils.php');
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
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="index.php">MobileCrunchers</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse justify-content-end navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link mc-nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mc-nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mc-nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mc-nav-link" href="my_accounts.php">My Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mc-nav-link" href="personal_support.php">Customer Support</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link mc-nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Login/Register
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item mc-color-gray-02" href="login.php"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a></li>
                    <li><a class="dropdown-item mc-color-gray-02" href="change_password.php"><i class="bi bi-person-add me-2"></i>Change Password</a></li>
                    <li><a class="dropdown-item mc-color-gray-02" href="register.php"><i class="bi bi-person-add me-2"></i>Register</a></li>
                    <li><a class="dropdown-item mc-color-gray-02" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    <!-- Navbar -->

    <!-- Background image -->
        <div class="text-center" style="background-image: url('images/phones.jpeg'); height: 420px; background-size: cover;">
            <div class="mask p-5 h-100" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                <h1 class="mb-3 mc-color-secondary">MobileCrunchers</h1>
                <h5 class="mb-3">Innovation at your fingertips</h5>
                <a class="btn btn-outline-light btn-lg" href="products.php" role="button"
                >See products</a
                >
                </div>
            </div>
            </div>
        </div>
    <!-- Background image -->
    </header>
    <div class="container-fluid">
        <h1 class="text-center my-4">MobileCrunchers - Product Details</h1>
    <?php

    $html = "";

    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
        $productId = FormValidationUtils::sanitizeFields($_GET["id"]);
        $product = new Product();
        try {
            $productDetail = $product->getProductById($productId);
            if ($productDetail) {
                $id = $productDetail->getId();
                $name = $productDetail->getName();
                $price = $productDetail->getPrice();
                $quantity = $productDetail->getQuantity();
                $imagePath = $productDetail->getImagePath();
                $RAM = $productDetail->getRAM();
                $storageCapacity = $productDetail->getStorageCapacity();
                $screenSize = $productDetail->getScreenSize();
                $processorType = $productDetail->getProcessorType();
                $processorSpeed = $productDetail->getProcessorSpeed();
                $opticalSensorResolution = $productDetail->getOpticalSensorResolution();
                $weight = $productDetail->getWeight();
                $dimension = $productDetail->getDimension();
                $manufacturer = $productDetail->getManufacturer();
                $os = $productDetail->getOS();
                $html = "<div class='card px-4 py-2 col-md-4 mx-auto'>";
                $html .= "<div class='mt-3'>";
                    $html .= "<span class='badge text-bg-primary'>ID: $id</span>";
                $html .= "</div>";
                $html .= "<h2 class='mc-color-secondary'>$name</h2>";
                $html .= "<img class='product-image' src='images/{$imagePath}' alt='{$imagePath}'>";
                $html .= "<div class='mb-4'>";
                    $html .= "<span class='badge mc-bg-info me-3'>$manufacturer</span>";
                    $html .= "<span class='badge mc-bg-info'>$os</span>";
                $html .= "</div>";
                $html .= "<h5>Quantity: $quantity</h5>";
                $html .= "<h5>RAM: $RAM</h5>";
                $html .= "<h5>Storage Cpacity: $storageCapacity</h5>";
                $html .= "<h5>Screen Size: $screenSize</h5>";
                $html .= "<h5>Processor Type: $processorType</h5>";
                $html .= "<h5>Processor Speed: $processorSpeed</h5>";
                $html .= "<h5>Optical Sensor Resolution: $opticalSensorResolution</h5>";
                $html .= "<h5>Weight: $weight</h5>";
                $html .= "<h5>Dimension: $dimension</h5>";
                $html .= "<h4 class='mc-color-primary mt-3'><em>$$price</em></h4>";
                $html .= "</div>";
            } else {
                $html = "<div>Product Not Found!</div>";
            }
        } catch (Exception $e) {
            $html = "<div>ERROR!! " . $e->getMessage() . "</div>";
        }
    } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!isset($_SESSION['userId']) || !$_SESSION['userId']) {
            header('location: login.php');
            exit();
        }
        $productId = FormValidationUtils::sanitizeFields($_POST["productId"]);
        $quantity = FormValidationUtils::sanitizeFields($_POST["quantity"]);
        $product = new Product();
        $productDetail = $product->getProductById($productId);
        $price = $productDetail->getPrice();
        $imagePath = $productDetail->getImagePath();
        $name = $productDetail->getName();

        if (isset($_SESSION["Cart"])) {
            $cart = new Cart(["userId" => $_SESSION["userId"]]);
            $cartDetails = $cart->getCartDetails();
            $cartProductIds = [];
            foreach ($cartDetails as $cartDetail) {
                $cartProductIds[] = $cartDetail->getProductId();
            }

            if (in_array($productId, $cartProductIds)) {
                foreach ($cartDetails as $cartDetail) {
                    if ($cartDetail->getProductId() == $productId) {
                        $cart->setTotal($cart->getTotal() + ($quantity * $cartDetail->getPrice()));
                        $cartDetail->setQuantity($cartDetail->getQuantity() + $quantity);
                        $cart->updateCart();
                        $cart->updateCartDetails($cartDetail->getQuantity(), $cartDetail->getProductId());
                        break;
                    }
                }
            } else {
                $cart->setTotal($cart->getTotal() + ($quantity * $price));
                $cart->updateCart();
                $cart->insertCartDetails($quantity, $productId);
            }
        } else {
            addNewCart(
                $productId,
                $quantity,
                $name,
                $price,
                $imagePath
            );
        }
        $html = "<script>alert('Product added to cart!');</script>";
        header('location: cart.php');
    } else {
        $html = "<div>Invalid Page Request</div>";
    }

    function addNewCart(
        $productId,
        $quantity,
        $name,
        $price,
        $imagePath
    ) {
        $cartDetail = new CartDetail(
            null,
            $productId,
            $quantity,
            $name,
            $price,
            $imagePath
        );
        $cart = new Cart(array(
            "userId" => $_SESSION["userId"],
            "total" => $price * $quantity,
            "cartDetail" => $cartDetail
        ));
        $cart->newCart();
    }

    echo $html;
?>

<form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-md-4 my-4 mx-auto d-flex justify-content-center">
    <input type="hidden" value="<?= $productId ?>" name="productId" />
    <select class="form-select form-select-lg me-2" name="quantity">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <input type="submit" value="Add to Cart" class="btn btn-primary">
</div>
</form>
<footer class="text-center text-white">
    <div class="text-center p-3 mc-bg-primary">
        © 2023 Copyright. MobileCrunchers.
    </div>
</footer>
</body>
</html>