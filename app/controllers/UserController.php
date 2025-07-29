<?php

class UserController
{

    public function showRegisterForm()
    {

        render('user/register');
    }

    public function register()
    {
        $user = new User();

        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
    }
}
