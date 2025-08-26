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
       public function getUserById($id){
        $query = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt ->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount()==1){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
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
        $this->username = sanitize(($this->username));
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $this->email = sanitize(($this->email));

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
        $this->email = sanitize(($this->email));
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();


        if ($stmt->rowCount() == 0) {
            session_start();
            $_SESSION['user_with_email_not_exists'] = 'User with this email doesn\'t exist';
        } else {
            $query = "SELECT id, username, password FROM $this->table WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $this->email);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPasswordFromDB = $row['password'];

            if (password_verify($this->password, $hashedPasswordFromDB)) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                return true;
            } else {
                return false;
            }
        }
    }
}
