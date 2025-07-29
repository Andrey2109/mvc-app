<?php

class UserController
{

    public function showRegisterForm()
    {

        render('user/register');
    }

    public function registerUser()
    {

        var_dump($_POST);
    }
}
