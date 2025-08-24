<?php

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/about' => 'HomeController@about',
        '/contact' => 'HomeController@contact',
        '/user/register' => 'UserController@showRegisterForm',
        '/user/login' => 'UserController@showLoginForm',
        '/dashboard' => 'AdminController@showDashboard',
        '/admin' => 'AdminController@admin',
         '/admin/users/profile' => 'UserController@showProfile'
    ],
    'POST' => [
        '/register' => 'UserController@register',
        '/login' => 'UserController@login',
        '/logout' => 'UserController@logout'
    ]
];


// $routes = [
//     '' => 'HomeController@index',
//     'about' => 'HomeController@about',
//     'user/register' => 'UserController@register'
// ];
