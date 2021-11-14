<?php

namespace App\Controllers;

class SiteController
{
    public function index()
    {
        //echo "Index method";
        include __DIR__.'/../../viwes/main.php';
    }

    public function notFound()
    {
        //echo "404";
        include __DIR__.'/../../viwes/404.php';
    }
}