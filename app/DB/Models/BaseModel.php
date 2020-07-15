<?php

namespace App\DB\Models;

use App\DB\DBConnection;

/**
 * Class BaseModel
 * @package App\DB\Models
 */
abstract class BaseModel
{
    protected static $instance;
    protected $table;
    protected $attributes;

    /**
     * BaseModel constructor.
     * @param $attributes
     */
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            $class = get_called_class(); // App\Models\News
            self::$instance = new $class();
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        if ($this->table) {
            return $this->table;
        }

        $fullClassName = get_called_class();

        $className = strtolower(end(explode("\\", $fullClassName)));
        if (str_ends_with($className, 's')) {
            return $className;
        }

        return $className . "s";
    }

    public static function get(int $id)
    {
        $tableName = self::getInstance()->getTableName();
        $sql = "SELECT * FROM $tableName WHERE id = $id LIMIT 1";
        $conn = DBConnection::getConnection();
        $result = $conn->query($sql);
        self::getInstance()->attributes = $result->fetch_assoc();

        return self::getInstance();
    }

    public static function all()
    {
        $tableName = self::getInstance()->getTableName();
        $sql = "SELECT * FROM $tableName";
        $result = DBConnection::getConnection()->query($sql);

        $items = [];
        while ($data = $result->fetch_assoc()) {
            $class = get_called_class();
            $object = new $class($data);
            array_push($items, $object);
        }

        return $items;
    }

    public static function update(int $id, array $data)
    {
        $tableName = self::getInstance()->getTableName();
        $sql = "UPDATE $tableName SET ";

        $index = 0;
        foreach ($data as $key => $value) {
            $value = mysqli_real_escape_string(DBConnection::getConnection(), $value);
            $sql .= "$key='$value'";
            $sql .= $index < count($data) - 1 ? ", " : " ";
            $index++;
        }

        $sql .= " WHERE id=$id";

        $result = DBConnection::getConnection()->query($sql);
    }

    public static function create(array $data)
    {
        $tableName = self::getInstance()->getTableName();
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

        $tableName = self::getInstance()->getTableName();
        $sql = "DELETE FROM $tableName WHERE id=$id";
        return DBConnection::getConnection()->query($sql);
    }

    public static function paginate(int $limit, int $offset): array
    {
        $tableName = self::getInstance()->getTableName();
        $sql = "SELECT * FROM $tableName LIMIT  $offset, $limit";
        $result = DBConnection::getConnection()->query($sql);

        $sqlCount = "SELECT COUNT(*) FROM $tableName";
        $total = (int)array_shift(DBConnection::getConnection()->query($sqlCount)->fetch_row());

        $items = [];
        while ($data = $result->fetch_assoc()) {
            $class = get_called_class();
            $object = new $class($data);
            array_push($items, $object);
        }

        return [
            'total' => $total,
            'items' => $items
        ];
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->attributes);
    }
}