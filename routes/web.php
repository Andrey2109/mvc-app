<?php

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/about' => 'HomeController@about',
        '/user/register' => 'UserController@showRegisterForm',
        '/user/login' => 'UserController@showLoginForm',
        '/admin/dashboard' => 'UserController@showAdminDashboard'
    ],
    'POST' => [
        '/register' => 'UserController@register',
        '/login' => 'UserController@login'
    ]
];


// $routes = [
//     '' => 'HomeController@index',
//     'about' => 'HomeController@about',
//     'user/register' => 'UserController@register'
// ];
