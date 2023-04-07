<?php
require_once('./db/User.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfLoggedIn();
$user = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User($_POST);
    if (count($user->getErrors()) == 0) $user->registerUser();
}

?>

<!doctype html>
<html>

<body>
    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        FName: <input type="text" name="firstName" value="<?= $user ? $user->getFirstName() : '' ?>" />
        LName: <input type="text" name="lastName" value="<?= $user ? $user->getLastName() : '' ?>" />
        Email: <input type="text" name="email" value="<?= $user ? $user->getEmail() : '' ?>" />
        Phone: <input type="text" name="phone" value="<?= $user ? $user->getPhone() : '' ?>" />
        Username: <input type="text" name="username" value="<?= $user ? $user->getUsername() : '' ?>" />
        Password: <input type="text" name="password" value="<?= $user ? $user->getPassword() : '' ?>" />
        <input type="submit" value="Register" />
    </form>
    <?php if ($user) {
        foreach ($user->getErrors() as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>
</body>

</html>