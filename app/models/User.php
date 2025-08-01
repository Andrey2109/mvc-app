<?php

class User
{
    public $table = 'users';

    public $id;
    public $username;
    public $password;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $birthday;
    public $organization;
    public $location;
    public $profile_image;
    public $created_at;
    public $updated_at;

    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::getInstance()->getConnection();
    }

    public function UserAlreadyExist($username)
    {
        $query = "SELECT username FROM $this->table WHERE username=:username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);

        $stmt->execute();
        // $stmt->debugDumpParams();
        // die();

        return ($stmt->rowCount() > 0);
    }

    public function store()
    {
        $query = 'INSERT INTO ' . $this->table . ' (username, password, email) VALUES (:username, :password, :email)';
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $this->email = htmlspecialchars(strip_tags($this->email));

        if ($this->UserAlreadyExist($this->username)) {
            return false;
        }


        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function loginCheck()
    {
        $query = "SELECT email FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();


        if ($stmt->rowCount() == 0) {
            session_start();
            $_SESSION['user_with_email_exists'] = 'User with this email doesn\'t exist';
            return true;
        } else {
            $query = "SELECT password FROM $this->table WHERE password = :password";
            $stmt = $this->conn->prepare($query);
            $this->password =   password_verify($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $this->password);
            $stmt->execute();
        }
    }
}
