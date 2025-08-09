<?php

class AuthMiddleware
{

    public static function isAuthenticated()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['username']) && !empty($_SESSION['username']);
    }
}
