<?php
require_once("./db/Product.php");
?>
<!DOCTYPE html>
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
            <li class="nav-item">
                <a class="nav-link mc-nav-link" href="personal_support.php">Customer Support</a>
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
        <h1 class="text-center my-4">MobileCrunchers - Products</h1>
        <?php
            $products = new Product();
            $productsList = $products->getProductList();

            $html = "<div class='py-5'>";
                $html .= "<div class='container'>";
                    $html .= "<div class='row hidden-md-up'>";
                        foreach ($productsList as $product) {
                            $id = $product->getId();
                            $name = $product->getName();
                            $price = $product->getPrice();
                            $quantity = $product->getQuantity();
                            $image_path = $product->getImagePath();
                            $manufacturer = $product->getManufacturer();
                            $os = $product->getOS();
                            $html .= "<div class='col-md-4 mb-4'>";
                                $html .= "<div class='card p-3 d-flex flex-column align-items-center'>";
                                    $html .= "<h3 class='text-center mc-color-secondary'>$name</h3>";
                                    $html .= "<div class='mb-3'>";
                                        $html .= "<span class='me-4 badge mc-bg-info'>$manufacturer</span>";
                                        $html .= "<span class='badge mc-bg-info'>$os</span>";
                                    $html .= "</div>";
                                    $html .= "<img class='product-image' src='images/{$image_path}' alt='{$image_path}'>";
                                    $html .= "<h4 class='mc-color-primary'>$$price</h4>";
                                    $html .= "<div class='d-grid col-6 mx-auto'>";
                                        $html .= "<a href='product_details.php?id=$id' class='btn btn-secondary'>View Details</a>";
                                    $html .= "</div>";
                                $html .= "</div>";
                            $html .= "</div>";
                        }
                    $html .= "</div>";
                $html .= "</div>";
            $html .= "</div>";
            echo $html;
        ?>
</div>

<footer class="text-center text-white">
  <div class="text-center p-3 mc-bg-primary">
    © 2023 Copyright. MobileCrunchers.
  </div>
</footer>
</body>
</html>