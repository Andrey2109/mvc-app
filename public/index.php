<?php
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php';



$request = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';



if (array_key_exists($request, $routes)) {
    $route = explode('@', $routes[$request]);
    $controllerName =
        var_dump($route);
    echo 'It does exists';
} else {
    echo "it doesn't exists";
}
