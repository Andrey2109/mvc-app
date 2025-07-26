<?php

class DataBase
{
    private static $instance = null;

    private $connection;

    public function __construct()
    {
        $config = require base_path('config/config.php');
        $dbConfig = $config['database'];
        $database = $dbConfig['database'];
        $host = $dbConfig['host'];
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];
        $charset = $dbConfig['charset'];
        $port = $dbConfig['port'];

        $dsn = "mysql:host={$host};dbname={$database};charset={$charset};port={$port}";

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connnection failed " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function __clone() {}
    public   function __wakeup() {}
}
