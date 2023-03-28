<?php
require_once('database.php');
require_once('queries.php');
session_start();

class Cart
{
    protected $userId;
    protected $errors;
    protected $pdo;

    public function __construct($data)
    {
        if (!$this->pdo) $this->pdo = Database::getConnection();
    }
}
