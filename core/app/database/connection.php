<?php

namespace App\Database;

use PDO;

define('DB_HOST', 'db');
define('DB_USER', 'root');
define('DB_DATABASE', 'php_mvc');
define('DB_PASSWORD', 'root');

class Connection
{
    private static $instance;
    private $host;
    private $database;
    private $username;
    private $password;

    protected $connection;

    private function __construct()
    {
        $this->host = DB_HOST;
        $this->database = DB_DATABASE;
        $this->username = DB_USER;
        $this->password = DB_PASSWORD;
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function connect()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
