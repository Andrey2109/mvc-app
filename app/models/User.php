<?php

class User
{
    public $table = 'users';
    public $id;
    public $username;
    public $password;
    public $email;

    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::getInstance()->getConnection();
    }

    public function store()
    {
        $query = 'INSERT INTO ' . $this->table . ' username, password, email VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
    }
}
