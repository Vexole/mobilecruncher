<?php
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

<body>
    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        FName: <input type="text" name="firstName" disabled value="<?= $user ? $user->getFirstName() : '' ?>" />
        LName: <input type="text" name="lastName" disabled value="<?= $user ? $user->getLastName() : '' ?>" />
        Email: <input type="text" name="email" value="<?= $user ? $user->getEmail() : '' ?>" />
        Phone: <input type="text" name="phone" value="<?= $user ? $user->getPhone() : '' ?>" />
        <input type="submit" name="cta" value="UPDATE" />
        <input type="submit" name="cta" value="DELETE" />
    </form>

    <?php if ($user) {
        foreach ($user->getErrors() as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>
</body>

</html>