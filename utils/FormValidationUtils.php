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

    public static function validateFormData(
        $plantName,
        $binomialName,
        $plantDescription,
        $price,
        $quantity,
        $selectedTypeID,
        $selectedSizeID
    ) {
        $errors = [];
        if (empty($plantName) || !FormValidationUtils::validateName($plantName)) {
            $errors[] = "Invalid Plant Name";
        }

        if (empty($binomialName) || !FormValidationUtils::validateName($binomialName)) {
            $errors[] = "Invalid Binomial Name";
        }

        if (empty($plantDescription)) {
            $errors[] = "Invalid Plant Description";
        }

        if (empty($price) || !FormValidationUtils::validatePrice($price)) {
            $errors[] = "Invalid Price (Enter in format ### or ###.##)";
        }

        if (empty($quantity) || !FormValidationUtils::validateNumber($quantity)) {
            $errors[] = "Invalid Quantity";
        }

        if (empty($selectedTypeID)) {
            $errors[] = "Please select plant type";
        }
        if (empty($selectedSizeID)) {
            $errors[] = "Please select plant size";
        }

        return $errors;
    }
}
