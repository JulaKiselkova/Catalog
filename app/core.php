<?php

$connection = new mysqli('localhost', 'root', '', 'MVC');

if(mysqli_connect_errno()) {
    echo "NO DB connection";
    die();
}

function render($template = '', $vars = []) {
    foreach ($vars as $varName => $varValue) {
        ${$varName} = $varValue; //динамич создание переменной.
    }

    $path = __DIR__."/../viwes/".$template;
    if(file_exists($path) && is_file($path)) {
        include $path;
    } else {
        echo "View not found";
    }
}
?>