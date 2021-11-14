<?php

namespace App\Controllers;

class CatalogController
{
    public function index() {
        include __DIR__.'/../../viwes/catalog.php';
    }

    public function showProduct() {
        include __DIR__.'/../../viwes/catalog12.php';
    }
}