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
        $data = [
            'title' => 'Admin Page',
            'message' => 'Welcome to the Admin Page'
        ];

        render('admin/dashboard', $data, 'layouts/admin_layout');
        // require_once __DIR__ . '/../views/home/index.php';
    }
}
