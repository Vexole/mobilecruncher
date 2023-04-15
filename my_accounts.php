<?php
session_start();
require_once('./db/User.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfNotLoggedIn();
$user = new User([]);
$user->getUser();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['cta'] === "UPDATE") {
        $user = new User($_POST);
        if (count($user->getErrors()) == 0) $user->updateUser();
    }

    if ($_POST['cta'] === "DELETE") {
        $user = new User([]);
        $user->deleteUser();
        $user->logoutUser();
        header("location: index.php");
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
        <h1 class="text-center my-4">MobileCrunchers - My Accounts</h1>
        <?php if ($user) {
            foreach ($user->getErrors() as $error) {
                echo "<h6 class='text-danger text-center mt-3'>$error</h6>";
            }
        }
        ?>
        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center flex-column mb-5">
            <div class="form-group col-md-4 mx-auto">
                <label for="firstname"><em>First Name</em></label>
                <input type="text" class="form-control" id="firstname" name="firstName" placeholder="First Name" aria-label="First Name" aria-describedby="First Name" disabled value="<?= $user ? $user->getFirstName() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto">
                <label for="username"><em>Last Name</em></label>
                <input type="text" class="form-control" id="lastname" name="lastName" placeholder="Last Name" aria-label="Last Name" aria-describedby="Last Name" disabled value="<?= $user ? $user->getLastName() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto">
                <label for="username"><em>Email</em></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" aria-label="Email" aria-describedby="Email" value="<?= $user ? $user->getEmail() : '' ?>">
            </div>
            <div class="form-group col-md-4 mx-auto mt-3">
                <label for="phone"><em>Phone</em></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="Phone" name="phone" value="<?= $user ? $user->getPhone() : '' ?>">
            </div>
            <div class="col-md-4 d-flex mx-auto">
                <button type="submit" name="cta" value="UPDATE" class="btn btn-primary mt-4 col-md-6 mx-auto me-2">Update</button>
                <button type="submit" name="cta" value="DELETE" class="btn btn-primary mt-4 col-md-6 mx-auto">Delete</button>
            </div>
        </form>
    </div>
    <?php include_once('components/footer.php') ?>
</body>

</html>