<?php
session_start();
require_once('./db/User.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfNotLoggedIn();

$user = new User([]);
$user->getUser();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User($_POST);
    if (count($user->getErrors()) == 0) $user->changePassword();
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
        <h1 class="text-center my-4">MobileCrunchers - Change Password</h1>
        <?php
        if ($user) {
            foreach ($user->getErrors() as $error) {
                echo "<h6 class='text-danger text-center mt-3'>$error</h6>";
            }
        }
        ?>
        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center flex-column mb-5">
            <div class="form-group col-md-4 mx-auto">
                <label for="username"><em>Username</em></label>
                <input type="text" class="form-control" id="username" name="username" disabled placeholder="Username" aria-label="Username" aria-describedby="username" value="<?= $user ? $user->getUsername() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="password"><em>New Password</em></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="Password" aria-describedby="password">
            </div>
            <button type="submit" class="btn btn-primary mt-4 col-md-2 mx-auto">Change Password</button>
        </form>
    </div>
    <?php include_once('components/footer.php') ?>

</body>

</html>