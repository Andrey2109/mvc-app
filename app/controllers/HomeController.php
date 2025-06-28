<?php
class HomeController
{

    public function index()
    {
        $message = "Some message";
        require_once __DIR__ . '/../views/home/index.php';
    }
    public function testing()
    {
        echo 'returning testing';
    }
}
