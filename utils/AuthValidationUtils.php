<?php

class AuthValidationUtils {
    static function redirectIfLoggedIn()
    {
        if (!empty($_SESSION["userId"])) {
            header("location: index.php");
        }
    }

    static function redirectIfNotLoggedIn()
    {
        if (empty($_SESSION["userId"])) {
            header("location: login.php");
        }
    }
}