<?php

namespace App\DB\Models;

use App\DB\DBConnection;

/**
 * Class BaseModel
 * @package App\DB\Models
 */
abstract class BaseModel
{
    abstract static function getTableName(): string;

    public static function get(int $id)
    {
        $tableName = call_user_func([get_called_class(), 'getTableName']);
        $sql = "SELECT * FROM $tableName WHERE id = $id LIMIT 1";
        $conn = DBConnection::getConnection();
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function update(int $id, array $data)
    {
        $tableName = call_user_func([get_called_class(), 'getTableName']);
        $sql = "UPDATE $tableName SET ";

        $index = 0;
        foreach ($data as $key => $value) {
            $sql .= "$data='$value'" . $index < count($data) - 1 ? ", " : " ";
            $index++;
        }

        $sql .= " WHERE $id=$id";
    }

    public static function create(array $data)
    {
        $tableName = call_user_func([get_called_class(), 'getTableName']);
        $keys = implode(", ", array_keys($data));
        $values = implode(", ",
            array_map(
                function ($value) {
                    return "'$value'";
                },
                array_values($data)
            )
        );

        $sql = "INSERT INTO $tableName($keys) VALUES($values)";

        return DBConnection::getConnection()->query($sql);
    }

    public static function delete(int $id)
    {
        if (!$id || $id < 0) {
            return false;
        }

        $tableName = call_user_func([get_called_class(), 'getTableName']);
        $sql = "DELETE FROM $tableName WHERE id=$id";
        return DBConnection::getConnection()->query($sql);
    }
}