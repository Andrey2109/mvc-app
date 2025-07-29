<?php

class DataBase
{
    private static $instance = null;

    private $connection;

    public function __construct()
    {
        $database = config('database.database');
        $username = config('database.username');
        $host = config('database.host');
        $password = config('database.password');
        $charset = config('database.charset');
        $port = config('database.port');

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
