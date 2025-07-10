<?php


function base_url(){

    $protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") || $_SERVER['SERVER_PORT'] === 443 ? 'https://' : 'http://';
    $host = $_SERVER ["HTTP_HOST"];

}

function render($view, $data=[], $layout = 'layout'){
    extract($data);

    ob_start();

    require __DIR__ . "/views/". $view . ".php";

    $content = ob_get_clean();

    require __DIR__  . "/views/" . $layout . ".php";

}