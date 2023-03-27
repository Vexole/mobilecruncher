<?php

require_once('config.php');

class Database
{  
    static protected $dbc = null;

    static function getConnection()
    {
        if (self::$dbc == null) {
            try {
                self::$dbc = new PDO("mysql:host=" . DB_HOST . ";charset=" . CHARSET .
                    ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
                self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (DBException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$dbc;
    }
}
