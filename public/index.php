<?php
    include '../vendor/autoload.php';
    include '../app/core.php';

    $routs = [
        '/' => 'App\\Controllers\\SiteController@index',
        '/catalog' => 'App\\Controllers\\CatalogController@index',
        '/product' => 'App\\Controllers\\CatalogController@showProduct',
        '/add_product_form' => 'App\\Controllers\\CatalogController@showForm',
        '/save_product' => 'App\\Controllers\\CatalogController@saveProduct',
        '/form_homeTask' => 'App\\Controllers\\CatalogController@showFormHomeTask',
        '/save_homeTask' => 'App\\Controllers\\CatalogController@saveHomeTask',
    ];

    $runAction = 'App\\Controllers\\SiteController@notFound';
    $uri = explode('?', $_SERVER['REQUEST_URI']);
    $uri = $uri[0];

    foreach ($routs as $route => $action) {
        if($uri === $route) {
            $runAction = $action;
            break;
        }
    }
    $runAction = explode('@', $runAction);
    //print_r($runAction);
    $controller = new $runAction[0];
    $controller->{$runAction[1]}();