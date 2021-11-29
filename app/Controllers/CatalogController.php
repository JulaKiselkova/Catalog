<?php

namespace App\Controllers;

use App\Models\Product;

class CatalogController
{
    public function index()
    {
        render('catalog.php');
    }

    public function showProduct()
    {
        $id = (int)$_GET['id'];
        $product = Product::findById($id);
        var_dump($product);
        render('catalog12.php', ['product' => $product]);
    }

    public function showForm()
    {
        render('addProductForm.php');
    }

    public function saveProduct()
    {
        print_r($_FILES['img']);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $_FILES['img']['name'];
        //copy($_FILES['img']['tmp_name'], __DIR__.'/1.png');
        copy($_FILES['img']['tmp_name'], $path);
        move_uploaded_file($_FILES['img']['name'], $path);
        //print_r($_POST);
    }

}