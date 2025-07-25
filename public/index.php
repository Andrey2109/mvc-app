<?php
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php';



$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method  = $_SERVER['REQUEST_METHOD'];


if (isset($routes[$method][$request])) {

    list($controller, $action) = explode('@', $routes[$method][$request]);

    require_once __DIR__ . '/../app/controllers/' . $controller . '.php';

    $controllerInstance = new $controller;
    $controllerInstance->$action();
} else {
    http_response_code(404);
    echo '404 not found';
}


// if (array_key_exists($request, $routes)) {
//     $route = explode('@', $routes[$request]);
//     $controllerName = $route[0];
//     $methodName = $route[1];
//     $controller = new $controllerName();
//     $controller->$methodName();


//     // var_dump($controller);
//     // echo 'It does exists';
// } else {
//     echo "404 - Page not found;";
// }
