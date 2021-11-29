<?php

namespace App\Controllers;

use App\Models\Product;

class CatalogController
{
    public function index() {
        render('catalog.php');
    }

    public function showProduct() {

        $id = (int) $_GET['id'];
        $product = Product::findById($id);
        var_dump($product);
        render('catalog12.php', ['product' => $product]);
    }

    public  function showForm() {
        render('addProductForm.php');
    }

    public function saveProduct() {
        print_r($_FILES['img']);
        $path = $_SERVER['DOCUMENT_ROOT'].'/'.$_FILES['img']['name'];
        //copy($_FILES['img']['tmp_name'], __DIR__.'/1.png');
        copy($_FILES['img']['tmp_name'], $path);
        move_uploaded_file($_FILES['img']['name'], $path);
        //print_r($_POST);
    }


    //___HOMETASK___

    public function showFormHomeTask() {
        render('form_homeTask.php');
    }

    private function getFileType() {
        $arrInfo = [];
        $downloads = scandir(__DIR__.'/../../public/downloads/');
        for ($i = 2; $i < count($downloads); $i++) {
            $arrNameType = [];
            $fullFileType = mime_content_type(__DIR__.'/../../public/downloads/'.$downloads[$i]);
            $arr = explode("/", $fullFileType);
            array_push($arrNameType, [$downloads[$i], $arr[0] ,$arr[1]]);
            array_push($arrInfo, $arrNameType);
            echo $downloads[$i]." file type - ".$arr[1]."\n";
        }
        return $arrInfo;
    }

    private function makeSnakeCaseToCamel($fileName) {
        $arrFullName = str_split($fileName);
        if(in_array("_", $arrFullName)) {
            $arrSeparatedName = explode('_',$fileName);
            $nameCamelCase = $arrSeparatedName[0];
            for($i = 1; $i < count($arrSeparatedName); $i++) {
                $arrPartName = str_split($arrSeparatedName[$i]);

                $bigLetter = strtoupper($arrPartName[0]);
                array_shift($arrPartName);
                array_unshift($arrPartName, $bigLetter);

                $PartName = implode("", $arrPartName);
                $nameCamelCase = $nameCamelCase.$PartName;
            }
            return $nameCamelCase;
        } else {
            return $fileName;
        }
    }

    private function addFile() {
        for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
            $type = $_FILES['img']['type'][$i];
            $arrType = explode('/',$type);

            $newName = $this->makeSnakeCaseToCamel($_FILES['img']['name'][$i]);
            $arr = explode("/", $_FILES['img']['type'][$i]);
            echo $newName.' file type - '.$arr[1]."  ";
            if (!file_exists(__DIR__.'/../../public/downloads/'.$newName) && $arrType[0] === 'image') {
                move_uploaded_file($_FILES['img']['tmp_name'][$i], __DIR__.'/../../public/downloads/'.$newName);//добавление в папку

            }
        }
    }

    public function saveHomeTask() {
        $this->addFile();// добавляет в папку и выводит типы всех файлов из папки, которые мы добавили через форму
        echo " Files types for folder downloads: ";
        $this->getFileType();// возвращает тип файлов, которые находятся в папке
    }

}

