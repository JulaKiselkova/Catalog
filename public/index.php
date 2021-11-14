<?php
    include '../vendor/autoload.php';

    $routs = [
        '/' => 'App\\Controllers\\SiteController@index',
        '/catalog' => 'App\\Controllers\\CatalogController@index',
        '/catalog/12' => 'App\\Controllers\\CatalogController@showProduct'
    ];

    $runAction = 'App\\Controllers\\SiteController@notFound';

    foreach ($routs as $route => $action) {
        if($_SERVER['REQUEST_URI'] === $route) {
            $runAction = $action;
            break;
        }
    }
    $runAction = explode('@', $runAction);
    //print_r($runAction);
    $controller = new $runAction[0];
    $controller->{$runAction[1]}();