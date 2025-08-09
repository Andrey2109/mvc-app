<?php
class HomeController
{

    public function index()
    {

        $database = DataBase::getInstance();
        $conn = $database->getConnection();
        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to the Home Page'
        ];

        render('home/index', $data, 'layouts/hero_layout');
        require_once __DIR__ . '/../views/home/index.php';
    }
    public function about()
    {
        $data = [
            'title' => 'About Page',
            'message' => 'Welcome to the About Page'
        ];

        render('home/about', $data);
        // require_once __DIR__ . '/../views/home/index.php';
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Page',
            'message' => 'Welcome to the Contact Page'
        ];

        render('home/contact', $data);
    }
    public function testing()
    {
        echo 'returning testing';
    }
}
