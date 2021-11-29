<?php

namespace App\Models;

use mysqli;

class BaseModel {
    protected static $fillable = [];

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

    public function save() {
        $connection = self::getConnection();
        $tableName = static::getTableName();

        if (isset($this->id) && !empty($this->id)) {
            //update
        } else {
            $fields = implode(' , ', static::$fillable);
            $values = [];
        }
        $fields = implode(' , ', static::$fillable);
        $values = [];
        foreach (static::$fillable as $attributeName) {
            $values[] = $this->{$attributeName} ?? null;
        }
        $values = "'".implode(" ',' ", $values)."'";
        print_r($values);
        $sql = "INSERT into {$tableName} ({$fields}) VALUES ({$values})";
        $connection->query($sql);
        if ($connection->insert_id) {
            $this->id = $connection->insert_id;
        }
    }

}