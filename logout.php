<?php
require_once('./db/User.php');

$user = new User($_SESSION['userId']);
$user->logoutUser();
header('location: login.php');
