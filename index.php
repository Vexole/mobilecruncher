<?php
require_once('./db/User.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User($_POST);
    $result = $user->loginUser();
    if ($result) {
        echo "Yes";
    } else {
        echo "No";
    }
}

?>

<!doctype html>
<html>

<body>
    <form method="POST">
        FName: <input type="text" name="firstName" />
        LName: <input type="text" name="lastName" />
        Email: <input type="text" name="email" />
        Phone: <input type="text" name="phone" />
        Username: <input type="text" name="username" />
        Password: <input type="text" name="password" />
        <input type="submit" value="Login" />
    </form>
</body>

</html>