<?php
class HomeController
{

    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to the Home Page'
        ];

        render('home/index', $data);
        // require_once __DIR__ . '/../views/home/index.php';
    }
    public function testing()
    {
        echo 'returning testing';
    }
}
