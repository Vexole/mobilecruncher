<?php
require_once('Database.php');
require_once('Queries.php');
require_once('./utils/formValidationUtils.php');
require_once('Cart.php');
session_start();

class User
{
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $phone;
    protected $username;
    protected $password;
    protected $errors = [];
    protected $pdo;

    public function __construct($data)
    {
        if (!$this->pdo) $this->pdo = Database::getConnection();
        if (isset($data["firstName"])) $this->setFirstName($data['firstName']);
        if (isset($data["lastName"])) $this->setLastName($data['lastName']);
        if (isset($data["email"])) $this->setEmail($data['email']);
        if (isset($data["phone"])) $this->setphone($data['phone']);
        if (isset($data["username"])) $this->setUsername($data['username']);
        if (isset($data["password"])) $this->setPassword($data['password']);
    }

    function setFirstName($argFirstName)
    {
        $this->firstName = FormValidationUtils::sanitizeFields($argFirstName);
        if (empty($this->firstName) || !FormValidationUtils::validateName($this->firstName)) {
            $this->errors[] = "Invalid First Name.";
        }
    }

    function setLastName($argLastName)
    {
        $this->lastName = FormValidationUtils::sanitizeFields($argLastName);
        if (empty($this->lastName) || !FormValidationUtils::validateName($this->lastName)) {
            $this->errors[] = "Invalid Last Name.";
        }
    }

    function setEmail($argEmail)
    {
        $this->email = FormValidationUtils::sanitizeFields($argEmail);
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid Email Address.";
        }
    }

    function setUsername($argUsername)
    {
        $this->username = FormValidationUtils::sanitizeFields($argUsername);
        if (empty($this->username) || !FormValidationUtils::validateName($this->username)) {
            $this->errors[] = "Invalid Username.";
        }
    }

    function setPassword($argPassword)
    {
        $this->password = FormValidationUtils::sanitizeFields($argPassword);
        if (empty($this->password)) {
            $this->errors[] = "Invalid Password.";
        }
    }

    function setphone($argPhone)
    {
        $this->phone = FormValidationUtils::sanitizeFields($argPhone);
        if (empty($this->phone) || !FormValidationUtils::validateCellNumber($this->phone)) {
            $this->errors[] = "Invalid Phone Number.";
        }
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

    function getErrors()
    {
        return $this->errors;
    }

    public function registerUser()
    {
        try {
            $stmt = $this->pdo->prepare(Queries::$registerUserQuery);
            $stmt->execute([
                "firstName" => $this->firstName,
                "lastName" => $this->lastName,
                "email" => $this->email,
                "phone" => $this->phone,
                "username" => $this->username,
            ]);

            $id = $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare(Queries::$insertPasswordQuery);
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->execute([
                "userId" => $id,
                "password" => $hashedPassword
            ]);
            header('location: index.php');
        } catch (Exception $ex) {
            $this->errors[] = $ex->getMessage();
        }
    }

    public function loginUser()
    {
        try {
            $stmt = $this->pdo->prepare(Queries::$loginQuery);
            $stmt->execute([
                "username" => $this->username
            ]);
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($this->password, $row['password'])) {
                    session_regenerate_id();
                    $_SESSION["userId"] = $row['id'];

                    $cart = new Cart(["userId" => $row['id']]);
                    $cart->getCart();
                    
                    header('location: index.php');
                } else {
                    $this->errors[] = "Invalid credentials. Please try again!";
                }
            } else {
                $this->errors[] = "Invalid credentials. Please try again!";
            }
        } catch (Exception $ex) {
            $this->errors[] = $ex->getMessage();
        }
    }

    public function logoutUser()
    {
        $_SESSION = [];
        session_destroy();
        setcookie("PHPSESSID", '', time() - 1000, "/", '', 0, 0);
    }

    function redirectIfLoggedIn()
    {
        if (!empty($_SESSION["userId"])) {
            header("location: index.php");
        }
    }

    function redirectIfNotLoggedIn()
    {
        if (empty($_SESSION["userId"])) {
            header("location: login.php");
        }
    }
}
