<?php
require_once('./db/User.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfLoggedIn();

$user = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User($_POST);
    if (count($user->getErrors()) == 0) $user->loginUser();
}

?>

<!doctype html>
<html>

<body>
    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Username: <input type="text" name="username" value="<?= $user ? $user->getUsername() : '' ?>" />
        Password: <input type="text" name="password" />
        <input type="submit" value="Login" />
    </form>
    <a href="change_password.php">Change Password</a>
    <?php if ($user) {
        foreach ($user->getErrors() as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>
</body>
</html>