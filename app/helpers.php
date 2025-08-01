<?php




function base_url($path = '')
{

    if (defined('BASE_URL')) {
        return BASE_URL . ltrim($path, '/');
    }


    $protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") || $_SERVER['SERVER_PORT'] === 443 ? 'https://' : 'http://';
    $host = $_SERVER["HTTP_HOST"];
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

    return $protocol . $host . $base . '/' . ltrim($path, '/');
}

function base_path($path = '')
{
    return realpath(__DIR__ . '/../' . '/' . ltrim($path, '/'));
}

function views_path($path = '')
{
    return base_path(BASE_VIEWS . ltrim($path, '/\\'));
}

function redirect($path = '', $queryParams = [])
{
    $url = base_url($path);

    if (!empty($queryParams)) {
        $url .= '?' . http_build_query($queryParams);
    }

    header('Location: ' . $url);
    exit();
}

function render($view, $data = [], $layout = 'layout')
{
    extract($data);

    ob_start();

    require views_path($view . ".php");

    $content = ob_get_clean();

    require views_path($layout . ".php");
}

function config($key)
{
    $config = require base_path('config/config.php');
    $keys = explode('.', $key);

    $value = $config;

    foreach ($keys as $k) {

        if (!isset($value[$k])) {
            throw new Exception("Config key '{$k}' is not found");
        }

        $value = $value[$k];
    }

    return $value;
}
