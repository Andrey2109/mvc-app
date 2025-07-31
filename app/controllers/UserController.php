<?php

class UserController
{

    public function showRegisterForm()
    {

        render('user/register');
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
}
