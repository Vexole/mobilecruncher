<?php
require_once('Database.php');
require_once('queries.php');
require_once('./utils/FormValidationUtils.php');
session_start();

class User
{
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $username;
    protected $password;
    protected $phone;
    protected $errors;
    protected $pdo;

    public function __construct($data)
    {
        if (!$this->pdo) $this->pdo = Database::getConnection();
        if (isset($data["firstName"])) $this->setFirstName($data['firstName']);
        if (isset($data["lastName"])) $this->setLastName($data['lastName']);
        if (isset($data["email"])) $this->setEmail($data['email']);
        if (isset($data["username"])) $this->setUsername($data['username']);
        if (isset($data["password"])) $this->setPassword($data['password']);
        if (isset($data["phone"])) $this->setphone($data['phone']);
    }

    function setFirstName($argFirstName)
    {
        $this->firstName = FormValidationUtils::sanitizeFields($argFirstName);
    }

    function setLastName($argLastName)
    {
        $this->lastName = FormValidationUtils::sanitizeFields($argLastName);
    }

    function setEmail($argEmail)
    {
        $this->email = FormValidationUtils::sanitizeFields($argEmail);
    }

    function setUsername($argUsername)
    {
        $this->username = FormValidationUtils::sanitizeFields($argUsername);
    }

    function setPassword($argPassword)
    {
        $this->password = FormValidationUtils::sanitizeFields($argPassword);
    }

    function setphone($argPhone)
    {
        $this->phone = FormValidationUtils::sanitizeFields($argPhone);
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
        } catch (Exception $ex) {

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
                    return true;
                }
            }
            return false;
        } catch (Exception $ex) {

        }
    }
}
