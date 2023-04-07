<?php
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

<body>
    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Username: <input type="text" name="username" disabled value="<?= $user ? $user->getUsername() : '' ?>" />
        New Password: <input type="text" name="password" />
        <input type="submit" value="Change Password" />
    </form>

    <?php if ($user) {
        foreach ($user->getErrors() as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>
</body>

</html>