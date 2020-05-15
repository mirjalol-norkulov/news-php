<?php


class DBConnection
{
    private static $connection;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (!self::$connection) {
            $host = "mysql";
            $user = "mirjalol";
            $password = "123456789";
            $database = "my_database";

            self::$connection = new mysqli($host, $user, $password, $database);

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
}