<?php
class AdminController
{

    public function __construct() {}

    public function showDashboard()
    {

        if (!AuthMiddleware::isAuthenticated()) {
            redirect('/user/login');
        }

        $database = DataBase::getInstance();
        $conn = $database->getConnection();
        if(!empty($_SESSION['id'])){
            $query = $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $data = [
            'title' => 'Admin Page',
            'message' => 'Welcome to the Admin Page',
            'user' => $user
        ];

        render('admin/dashboard', $data, 'layouts/admin_layout');
        // require_once __DIR__ . '/../views/home/index.php';
    }

    public function admin()
    {

        if (!AuthMiddleware::isAuthenticated()) {
            redirect('/user/login');
        }

        $database = DataBase::getInstance();
        $conn = $database->getConnection();
        if(!empty($_SESSION['id'])){
            $query = $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $data = [
            'title' => 'Admin Page',
            'message' => 'Welcome to the Admin Page',
            'user' => $user
        ];

        render('admin/index', $data, 'layouts/admin_layout');
        // require_once __DIR__ . '/../views/home/index.php';
    }
}
