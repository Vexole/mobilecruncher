<?php
session_start();
require_once('./db/User.php');
require_once('./utils/AuthValidationUtils.php');

AuthValidationUtils::redirectIfNotLoggedIn();

$user = new User($_SESSION['userId']);
$user->logoutUser();
header('location: login.php');
