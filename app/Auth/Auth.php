<?php


namespace App\Auth;

use App\DB\DBConnection;
use App\Utils\Session;

/**
 * Class Auth
 * @package App\Auth
 */
class Auth
{
    const SESSION_KEY = "user";

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return Session::has(self::SESSION_KEY);
    }


    public static function user()
    {
        $userId = Session::get(self::SESSION_KEY);

        if (!isset($userId)) {
            return null;
        }

        $connection = DBConnection::getConnection();
        $sql = "SELECT * FROM users WHERE id = $userId LIMIT 1";
        $result = $connection->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }
}