<?php


namespace App\Auth;

use App\DB\DBConnection;
use App\DB\Models\User;
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
        return (new Session)->has(self::SESSION_KEY);
    }


    public static function user()
    {
        $userId = (new Session)->get(self::SESSION_KEY);

        if (!isset($userId)) {
            return null;
        }

        return User::get($userId);
    }
}