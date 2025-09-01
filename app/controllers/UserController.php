<?php

class UserController
{

    public $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function showRegisterForm()
    {
        $data = [
            'title' => 'Register'
        ];



        render('user/register', $data);
    }
    public function showLoginForm()
    {

        $data = [
            'title' => 'Login'
        ];

        render('user/login', $data);
    }


    public function register()

    {
         if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        

        $this->userModel->username = $_POST['username'];
        $this->userModel->email = $_POST['email'];
        $this->userModel->password = $_POST['password'];

        if ($this->userModel->store()) {
            redirect('/');
        } else {
            $_SESSION['error'] = 'The user already exists or registration failed.';
            redirect('/user/register');
        }
    }
    public function login()
    {
        

        $this->userModel->email = $_POST['email'];
        $this->userModel->password = $_POST['password'];

        if (isset($_SESSION['user_with_email_not_exists'])) {
            redirect('/user/register');
        } elseif ($this->userModel->loginCheck()) {
            $_SESSION['user_id'] = $this->userModel->id;
            $_SESSION['username'] = $this->userModel->username;
            redirect('/dashboard');
        } else {
            $_SESSION['wrong_password'] = 'Wrong password, try again';
            redirect('/user/login');
        }
    }
    public function showProfile(){

        $userId = $_SESSION['user_id'];

        $user = $this->userModel->getUserById($userId);
        

        $data = [
            'title' => 'Profile',
            'user' => $user
        ];

        render('admin/users/profile', $data, 'layouts/admin_layout');

    }

    public function logout()
    {

        unset($_SESSION['user_id'], $_SESSION['username']);
        session_destroy();

        redirect('/user/login');
    }
    public function updateUser(){
        $data=[
            'title' => 'Form Submision'
        ];
        render('/admin/users/update', $data, 'layouts/admin_layout');
    }
}
