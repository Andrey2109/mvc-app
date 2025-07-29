<?php

class UserController
{

    public function showRegisterForm()
    {

        render('user/register');
    }

    public function register()
    {

        var_dump($_POST);
    }
}
