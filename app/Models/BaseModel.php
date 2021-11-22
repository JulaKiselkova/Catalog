<?php

namespace App\Models;

use mysqli;

class BaseModel {
    protected static $tableName;
    protected static $connection;

    protected static function getConnection() {
        if(!self::$connection) {
            self::$connection = new mysqli('localhost', 'root', '', 'MVC');
        }
        return self::$connection;
    }

    public static function getTableName() {
        if(empty(static::$tableName)) {
            $className = static::class;
            $className = explode('\\', $className);
            $className = array_pop($className);
            $className = strtolower($className);
            $tableName = $className."s";
        } else {
            $tableName = static::$tableName;
        }
        return $tableName;
    }
    public function selectAll() {
        $connection = self::getConnection();
        $tableName = static::getTableName();
        $res = $connection->query("SELECT * FROM".$tableName);
        $arr = [];
        while ($row = $res->fetch_obgect(static::class)) {
            $arr[] = $row;
        }
    }

    public static function findById($id) {
        /**
         * @var mysqli $connection
        */

        $connection = self::getConnection();

        $sql = "select * from ".(static::getTableName())." where id = ?";
        //print_r($sql);
        $smth = $connection->prepare($sql);
        $tableName = static::getTableName();
        $smth->bind_param('i', $id);
        $smth->execute();
        $result = $smth->get_result();
        //var_dump($result->fetch_object(static::class));
        return $result->fetch_object(static::class);
    }

}