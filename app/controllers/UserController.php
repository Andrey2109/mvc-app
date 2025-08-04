<?php

class UserController
{

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
    public function showAdminDashboard()
    {
        render('admin/layout');
    }

    public function register()

    {
        session_start();
        $user = new User();

        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if ($user->store()) {
            redirect('/');
        } else {
            $_SESSION['error'] = 'The user already exists or registration failed.';
            redirect('/user/register');
        }
    }
    public function login()
    {
        $user = new User();

        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if (isset($_SESSION['user_with_email_not_exists'])) {
            redirect('/user/register');
        } elseif ($user->loginCheck()) {
            redirect('/admin/dashboard');
        } else {
            $_SESSION['wrong_password'] = 'Wrong password, try again';
            redirect('/user/login');
        }
    }
}
