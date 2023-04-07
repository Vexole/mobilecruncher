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
<div class="d-flex flex-column align-items-center pt-5">
  <h2 class="text-center my-4 mc-color-secondary">About Us</h2>
  <div class="d-flex justify-content-center align-items-center">
    <div class="col-md-6 p-3 text-center fst-italic">
      <At> Welcome to our mobile store! We are dedicated to providing our customers with the best possible shopping experience. Our store was established in 2010 with the goal of offering high-quality mobile phones and accessories at affordable prices. Since then, we have evolved to meet the changing needs of our customers by expanding our product line and offering new services such as phone repairs and trade-ins. At our mobile store, we believe that everyone deserves access to high-quality mobile phones and accessories at affordable prices. That’s why we work hard to source the best products from around the world and offer them at prices that are accessible to everyone.</p>
    </div>
    <div class="col-md-4">
      <img src="images/phonesheader.jpg" class="card-img-top mt-3" alt="Mobile Phones on About Us Section"/>
    </div>
  </div>
</div>

<div class="d-flex flex-column align-items-center pt-5">
    <h2 class="text-center my-4 mc-color-secondary">Why Choose Us?</h2>
    <div class="d-flex justify-content-center">
      <div class="card col-md-4 mt-4 me-4">
          <div class="card-body">
              <h5 class="card-title mc-color-gray-02 text-center"><i class="bi bi-arrow-repeat me-2"></i><em>Free Return</em></h5>
              <p class="card-text mc-color-gray text-center">30 days money back garantee.</p>
          </div>
      </div>
      <div class="card col-md-4 mt-4 me-4">
          <div class="card-body">
              <h5 class="card-title mc-color-gray-02 text-center"><i class="bi bi-currency-dollar me-2"></i><em>Free Shipping</em></h5>
              <p class="card-text mc-color-gray text-center">Free shipping on all order.</p>
          </div>
      </div>
      <div class="card col-md-4 mt-4 me-4">
          <div class="card-body">
              <h5 class="card-title mc-color-gray-02 text-center"><i class="bi bi-clock me-2"></i><em>Support 24/7</em></h5>
              <p class="card-text mc-color-gray text-center">Online support 24 hours a day.</p>
          </div>
      </div>
    </div>
</div>

<div class="d-flex flex-column align-items-center pt-5 pb-5">
    <h2 class="text-center mt-4 mb-2 mc-color-secondary">Customer Testimonials</h2>
    <h6 class="mc-color-gray text-center mb-4">What our customers are saying...</h6>
    <div class="d-flex justify-content-center">
      <div class="card col-md-2 me-4">
        <img src="images/customer1.jpg" class="card-img-top mt-3" alt="Customer Man Picture"/>
        <div class="card-body">
            <h6 class="card-title mc-color-primary text-center"><em>Lance Jarvisc</em></h6>
            <p class="card-text mc-color-gray text-center">I was blown away by how easy it was to find what I was looking for on this website. MobileCrunchers has a great selection of phones and accessories at affordable prices.</p>
        </div>
      </div>
      <div class="card col-md-2 me-4">
        <img src="images/customer2.jpg" class="card-img-top mt-3" alt="Customer Woman Picture"/>
        <div class="card-body">
            <h6 class="card-title mc-color-primary text-center"><em>Ericka Lynda</em></h6>
            <p class="card-text mc-color-gray text-center">I had a great experience shopping at this mobile store! The staff was knowledgeable and friendly, and they helped me find exactly what I was looking for.</p>
        </div>
      </div>
      <div class="card col-md-2 me-4">
        <img src="images/customer3.jpg" class="card-img-top mt-3" alt="Customer Man Picture"/>
        <div class="card-body">
            <h6 class="card-title mc-color-primary text-center"><em>Kat Park</em></h6>
            <p class="card-text mc-color-gray text-center">I recently purchased a new phone from this mobile store and I couldn't be happier with my purchase! The phone is high-quality and works perfectly.</p>
        </div>
      </div>
      <div class="card col-md-2 me-4">
        <img src="images/customer4.jpg" class="card-img-top mt-3" alt="Customer Woman Picture"/>
        <div class="card-body">
            <h6 class="card-title mc-color-primary text-center"><em>Neil Wilford</em></h6>
            <p class="card-text mc-color-gray text-center">I've been a customer of this mobile store for years and I've always been impressed with their selection of phones and accessories. The staff is always friendly and helpful..</p>
        </div>
      </div>
    </div>
</div>

<footer class="text-center text-white">
  <div class="text-center p-3 mc-bg-primary">
    © 2023 Copyright. MobileCrunchers.
  </div>
</footer>
</body>
</html>

<?php
// var_dump($response["results"]);

// ob_start();

// $invoice = new Invoice();
// $items = array(
//     array("name" => "Item 1", "qty" => "3", "price" => "45"),
//     array("name" => "Item 2", "qty" => "7", "price" => "75")
// );
// $sale = new Sale("Bhupesh", "Shrestha", "Cash", $items, 58, 880);
// $invoice->generateInvoice($sale);
// ob_end_flush();
?>



<?php
// ob_start();

// $invoice = new Invoice();
// $items = array(
//     array("name" => "Item 1", "qty" => "3", "price" => "45"),
//     array("name" => "Item 2", "qty" => "7", "price" => "75")
// );
// $sale = new Sale("Bhupesh", "Shrestha", "Cash", $items, 58, 880);
// $invoice->generateInvoice($sale);
// ob_end_flush();
?>