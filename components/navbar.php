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
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li class="nav-item"><a class="nav-link mc-nav-link" href="cart.php">Cart</a></li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link mc-nav-link" href="personal_support.php">Customer Support</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link mc-nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<i class="bi bi-person me-2"></i>' . ucfirst($_SESSION["username"]);
                        } else {
                            echo "Login/Register";
                        }  ?>
                    </a>
                    <ul class="dropdown-menu <?php if (isset($_SESSION['username'])) echo 'nav-auth';
                                                else echo 'nav-unauth'; ?>">
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo '<li><a class="dropdown-item mc-color-gray-02" href="login.php"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a></li>';
                            echo '<li><a class="dropdown-item mc-color-gray-02" href="register.php"><i class="bi bi-person-add me-2"></i>Register</a></li>';
                        } else {
                            echo '<li><a class="dropdown-item mc-color-gray-02" href="my_accounts.php"><i class="bi bi-person me-2"></i>My Accounts</a></li>';
                            echo '<li><a class="dropdown-item mc-color-gray-02" href="change_password.php"><i class="bi bi-lock me-2"></i>Change Password</a></li>';
                            echo '<li><a class="dropdown-item mc-color-gray-02" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>';
                        }  ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>