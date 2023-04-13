<?php
require_once("Database.php");
require_once("Queries.php");
require_once("./utils/formValidationUtils.php");

class Checkout
{
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $phone;
    protected $addressLine;
    protected $city;
    protected $country;
    protected $errors = [];
    protected $pdo;

    public function __construct($data)
    {
        $this->setFirstName($data['first_name']);
        $this->setLastName($data['last_name']);
        $this->setEmail($data['email']);
        $this->setPhone($data['phone']);
        $this->setAddressLine($data['address_line']);
        $this->setCity($data['city']);
        $this->setCountry($data['country']);
        $this->pdo = Database::getConnection();
    }

    public function setFirstName($firstName)
    {
        if (empty($firstName)) {
            $this->errors[] = "First name cannot be empty";
        } else {
            $this->firstName = FormValidationUtils::sanitizeFields($firstName);
        }
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        if (empty($lastName)) {
            $this->errors[] = "Last name cannot be empty";
        } else {
            $this->lastName = FormValidationUtils::sanitizeFields($lastName);
        }
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid email address";
        } else {
            $this->email = FormValidationUtils::sanitizeFields($email);
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        if (!preg_match('/^\d{10}$/', $phone)) {
            $this->errors[] = "Invalid phone number";
        } else {
            $this->phone = FormValidationUtils::sanitizeFields($phone);
        }
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setAddressLine($addressLine)
    {
        if (empty($addressLine)) {
            $this->errors[] = "Address line cannot be empty";
        } else {
            $this->addressLine = FormValidationUtils::sanitizeFields($addressLine);
        }
    }

    public function getAddressLine()
    {
        return $this->addressLine;
    }

    public function setCity($city)
    {
        if (empty($city)) {
            $this->errors[] = "City cannot be empty";
        } else {
            $this->city = FormValidationUtils::sanitizeFields($city);
        }
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCountry($country)
    {
        if (empty($country)) {
            $this->errors[] = "Country cannot be empty";
        } else {
            $this->country = FormValidationUtils::sanitizeFields($country);
        }
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function resetErrors() {
        $this->errors = [];
    }

    public function saveBillingAddress()
    {
        $stmt = $this->pdo->prepare(Queries::$saveBillingAddress);
        $stmt->execute([
            "firstName" => $this->getFirstName(),
            "lastName" => $this->getLastName(),
            "email" => $this->getEmail(),
            "phone" => $this->getPhone(),
            "addressLine" => $this->getAddressLine(),
            "city" => $this->getCity(),
            "country" => $this->getCountry()
        ]);

        return $this->pdo->lastInsertId();
    }
}
