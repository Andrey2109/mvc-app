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
        $query = 'INSERT INTO ' . $this->table . ' (username, password, email) VALUES (:username, :password, :email)';
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
