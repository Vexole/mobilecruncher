<?php

class FormValidationUtils
{
    public static function sanitizeFields($argFieldData)
    {
        $sanitizedData = trim($argFieldData);
        $sanitizedData = stripslashes($sanitizedData);
        $sanitizedData = htmlspecialchars($sanitizedData);
        return $sanitizedData;
    }

    public static function validateName($name)
    {
        $nameRegex = "/^[a-zA-Z ]{3,}$/";
        return preg_match($nameRegex, $name);
    }

    public static function validateNumber($number)
    {
        $numberRegex = "/^\d+$/";
        return preg_match($numberRegex, $number);
    }

    public static function validatePrice($price)
    {
        $priceRegex = "/^\d+(\.\d{2})?$/";
        return preg_match($priceRegex, $price);
    }

    public static function validateCellNumber($cellNumber) {
        $phoneRegex = "/^[0-9]{10}$/";
        return preg_match($phoneRegex, $cellNumber);
    }
}
