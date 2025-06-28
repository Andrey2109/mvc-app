<?php

function render($view, $data=[]){
    extract($data);

    ob_start();

    require __DIR__ . $view . ".php";

    $content = ob_get_clean();

    require __DIR__  . "/views/layout.php";

}