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
        $userame = $dbConfig['userame'];
        $password = $dbConfig['password'];
        $charset = $dbConfig['charset'];
        $port = $dbConfig['port'];

        $dsn = "mysql:host={$host};dbname={$database};charset={$charset};port={$port}";

        try {
            $this->$connection = new PDO($dsn, $username, $password);
            $this->$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connnection failed " . $e->getMessage();
        }
    }
}
