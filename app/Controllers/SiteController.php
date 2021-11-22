<?php

namespace App\Controllers;

//use App\Models\Product;
//use mysqli;

use App\Models\Product;

class SiteController
{
    public function index() {
//        $connection = new mysqli('localhost', 'root', '', 'MVC');
//        $res = $connection->query("SELECT * FROM products");
//        $products = [];
//
//        while ($row = $res->fetch_object(Product::class)) {
//            $products[] = $row;
//        }
//        //$products = $res->fetch_all(MYSQLI_ASSOC);
//        echo "<pre>";
//        print_r($products);
//        echo "<pre>";
        Product::findById(1);
        render('main.php');
    }

    public function notFound()
    {
        render('404.php');
    }
}